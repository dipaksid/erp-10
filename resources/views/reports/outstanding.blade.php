@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Outstanding Report</h1>
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
  <form id="reportform" method="post" action="{{url('report/outstanding')}}" target="_blank" >
    {{csrf_field()}}
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Until Date:</label>
        <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="untildate" value="{{ (isset($default['logindate']))?$default['logindate']:'' }}"/>
      </div>
      <div class="col-9">
		<div class="row form-check">
		  <div class="col-9">
			<label>Company:</label>
			<div class="col-6 form-check-label">
			  <input type="checkbox" class="form-check-input" name="comp_id[]" value="1" checked>
			  Brightwin Technology<br>
			  <input type="checkbox" class="form-check-input" name="comp_id[]" value="2" checked>
			  Brightwin Solution<br>
			  <input type="checkbox" class="form-check-input" name="comp_id[]" value="11" checked>
			  Tsen Auctioneer
			</div>
			
		  </div>
		</div>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Customer From:</label>
        <select class="form-control customerfromAutoSelect enterseq overflow-ellipsis" seq="1" name="customerfrom"
        placeholder="Customer search"
        data-url="{{ action('ReportController@customerlist') }}" autocomplete="off"></select>
      </div>
      <div class="col-3">
        <label for="title">Area From:</label>
        <select class="form-control enterseq" seq="3" name="areafr">
          <option value=""> -- Selection --</option>
          @if(isset($data["area"]))
            @foreach ($data["area"] as $rarea)
            <option value="{{$rarea['areacode']}}">{{$rarea['description']}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Customer To:</label>
        <select class="form-control customertoAutoSelect enterseq overflow-ellipsis" seq="2" name="customerto"
        placeholder="Customer search"
        data-url="{{ action('ReportController@customerlist') }}" autocomplete="off"></select>
      </div>
      <div class="col-3">
        <label for="title">Area To:</label>
        <select class="form-control enterseq" seq="4" name="areato">
          <option value=""> -- Selection --</option>
          @if(isset($data["area"]))
            @foreach ($data["area"] as $rarea)
            <option value="{{$rarea['areacode']}}">{{$rarea['description']}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
	<div class="row form-group">
      <div class="col-3">
        <label for="title">Group By Customer Group:</label>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="custgroup" name="custgroup">
         <label class="custom-control-label" for="custgroup"></label>
        </div>
      </div>
	</div>
    <a href="{{ action('HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a> <button type="submit" seq="5" class="btn btn-primary enterseq" id="btnAction">Print</button>  
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
          if($(this).attr("name")=="untildate"){
            $(".dropdown-menu").remove();
            if($(this).val().length==8){
              let date = new Date($(this).val().substr(4,4), ($(this).val().substr(2,2)-1), $(this).val().substr(0,2));
              var dd = date.getDate();
              var mm = date.getMonth()+1; 
              var yyyy = date.getFullYear();
              if(dd<10) {
                  dd='0'+dd;
              }
              if(mm<10) {
                  mm='0'+mm;
              }
              $(this).val(dd+"/"+mm+"/"+yyyy);
            }
          }
          return false; 
        }
      })
    })
    $('.customerfromAutoSelect').autoComplete({minLength:2,
      events: {
          searchPost: function (resultFromServer) {
              setTimeout(function(){
                 $('.customerfromAutoSelect').next().find('a').eq(0).addClass("active");
              },100)
              return resultFromServer;
          }
      }
    });
    $('.customerfromAutoSelect').keydown(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode==13){
        $("input").filter("[seq='2']").select();
        return false;
      }
    })
    $('.customerfromAutoSelect').on('change', function (e, datum) {
      setTimeout(function(){ 
        if($('.customerfromAutoSelect').val()==""){
          $('.customerfromAutoSelect').focus();
        } else {
          var ss = $('.customerfromAutoSelect').val().split(" = ");
          $('.customerfromAutoSelect').val(ss[0]);
        }
      },300);
      return false;
    });
    $("input.customerfromAutoSelect").attr("seq","1");

    $('.customertoAutoSelect').autoComplete({minLength:2,
      events: {
          searchPost: function (resultFromServer) {
              setTimeout(function(){
                 $('.customertoAutoSelect').next().find('a').eq(0).addClass("active");
              },100)
              return resultFromServer;
          }
      }
    });
    $('.customertoAutoSelect').keydown(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode==13){
        $("select").filter("[seq='3']").focus();
        return false;
      }
    })
    $('.customertoAutoSelect').on('change', function (e, datum) {
      setTimeout(function(){ 
        if($('.customertoAutoSelect').val()==""){
          $('.customertoAutoSelect').focus();
        } else {
          var ss = $('.customertoAutoSelect').val().split(" = ");
          $('.customertoAutoSelect').val(ss[0]);
        }
      },300);
      return false;
    });
    $('.customerfromAutoSelect').select()
    $("input.customertoAutoSelect").attr("seq","2");
    
    $("input[name='untildate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
        $(this).datepicker('hide');
    }); 
    
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

#doCheckCustModal .modal-dialog, #doCheckRcptModal .modal-dialog{
   position: fixed;
   top: 0;
   right: 10px;
   z-index: 10040;
   overflow: auto;
   overflow-y: auto;
}
#doCheckCustModal .form-group, #doCheckRcptModal .form-group{
  height: 200px;
  overflow: auto;
  width: 600px;
}

.modal-backdrop.show {
    opacity: 0.05;
}
</style>

@endsection