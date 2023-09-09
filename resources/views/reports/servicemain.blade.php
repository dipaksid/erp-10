@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Service Maintenance Report</h1>
  <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>
<div>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div><br />
  @endif
  @if(\Session::has('success'))
      <div class="alert alert-success">
          {{\Session::get('success')}}
      </div>
  @endif
  <form id="reportform" method="post" action="{{url('report/servicemain')}}" target="_blank" >
    {{csrf_field()}}
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Period (MM/YYYY)</label>
        <input type="text" class="form-control enterseq" placeholder="mm/yyyy" name="period" seq="1" maxlength="7" value="{{ (isset($default['logindate']))?substr($default['logindate'],3):'' }}"/>
      </div>
      <div class="col-3">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Include Invoice [Y/N]</label>
        <input type="text" class="form-control enterseq" name="inc_inv" seq="2" value="Y"/>
      </div>
      <div class="col-3">
      </div>
    </div>
    <a href="{{ action('HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a> <button type="submit" seq="3" class="btn btn-primary enterseq" maxlength="1" id="btnAction">Print</button>  
  </form>
</div>
@endsection

@section('footerjs')
<script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function(evt){
    $(".enterseq").each(function(i){
      $(this).keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        switch(keycode) {
          case 13:
            if($(this).is("input")) {
              $(this).val($(this).val().toUpperCase());
            } else if($(this).is("button[type='submit']")) {
              $(this).click();
              return false;
            }
            var dd = parseInt($(this).attr("seq"),10)+1;
            if( $(".enterseq").filter("[seq='"+dd+"']").length>0){
              if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='text']")) {
                $("input[type='text']").filter("[seq='"+dd+"']").select();
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                $("select").filter("[seq='"+dd+"']").focus();
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='date']")){
                $("input[type='date']").filter("[seq='"+dd+"']").focus();
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                $("button").filter("[seq='"+dd+"']").focus();
              }
            }
            break;
          case 38:
            if($(this).is("select")) {
              break;
            }
            var dd = (parseInt($(this).attr("seq"),10)>0)?(parseInt($(this).attr("seq"),10)-1):parseInt($(this).attr("seq"),10);
            if($("input[type='text']").filter("[seq='"+dd+"']").length>0){
              $("input[type='text']").filter("[seq='"+dd+"']").select();;
            } else if($("input[type='date']").filter("[seq='"+dd+"']").length>0){
              $("input[type='date']").filter("[seq='"+dd+"']").select();;
            } else if($("select").filter("[seq='"+dd+"']").length>0){
              $("select").filter("[seq='"+dd+"']").focus();;
            }
            break;
        } 
        if(keycode==13){
          if($(this).attr("name")=="period"){
            if($(this).val().length==6){
              let date = new Date($(this).val().substr(2,4), ($(this).val().substr(0,2)-1), 1);
              var mm = date.getMonth()+1; 
              var yyyy = date.getFullYear();
              if(mm<10) {
                  mm='0'+mm;
              }
              $(this).val(mm+"/"+yyyy);
            }
          }
          return false; 
        }
		if($(this).attr("name")=="inc_inv"){
			if(keycode!=89 && keycode!=78 && keycode!=46 && keycode!=8 && keycode!=37 && keycode!=39) {
				return false;
			}
		}
      })
    }) 
	$("input[name='period']").select();
  })
  
</script>
@endsection

@section('topbar')


@endsection

@section('csscontrol')

<style type="text/css">
.dropdown-menu
{ 
    /*width: 800px !important;*/ /* you can set by percentage too */
}
.datepicker{
  width: auto !important;
}

.modal-backdrop.show {
    opacity: 0.05;
}
</style>

@endsection