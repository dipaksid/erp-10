@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Sales Data Export (LHDN) Report</h1>
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
  <form id="reportform" method="post" action="{{url('report/salesexportlhdn')}}" target="_blank" >
    {{csrf_field()}}
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Period From:</label>
        <input type="text" class="form-control enterseq" placeholder="dd/mm/yyyy" name="datfr" seq="1" value="{{ (isset($default['logindate']))?'01/01/'.substr($default['logindate'],6,4):'' }}"/>
      </div>
      <div class="col-3">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Period To:</label>
        <input type="text" class="form-control enterseq" placeholder="dd/mm/yyyy" name="datto" seq="2" value="{{ (isset($default['logindate']))?'31/12/'.substr($default['logindate'],6,4):'' }}"/>
      </div>
      <div class="col-3">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Company:</label>
        <select class="form-control enterseq" seq="3" name="companyid">
          <option value=""> -- Selection --</option>
          @if(isset($data["company"]))
            @foreach ($data["company"] as $rcompany)
            <option value="{{$rcompany['id']}}">{{$rcompany['companyname']}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Export Type:</label>
        <select class="form-control enterseq" seq="4" name="exp_typ">
          <option value="1">Sales Invoices</option>
          <option value="2">Payment to Supplier</option>
        </select>
      </div>
      <div class="col-3">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Area:</label>
        <select class="form-control enterseq" seq="5" name="area">
          <option value=""> -- Selection --</option>
          @if(isset($data["area"]))
            @foreach ($data["area"] as $rarea)
            <option value="{{$rarea['areacode']}}">{{$rarea['description']}}</option>
            @endforeach
          @endif
        </select>
      </div>
      <div class="col-3">
      </div>
    </div>

    <div class="row form-group">
      <div class="col-3">
        <label for="title">Customer From:</label>
        <select class="form-control customerfromAutoSelect enterseq overflow-ellipsis" seq="6" name="customerfrom"
        placeholder="Customer search"
        data-url="{{ action('ReportController@customerlist') }}" autocomplete="off"></select>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Customer To:</label>
        <select class="form-control customertoAutoSelect enterseq overflow-ellipsis" seq="7" name="customerto"
        placeholder="Customer search"
        data-url="{{ action('ReportController@customerlist') }}" autocomplete="off"></select>
      </div>
    </div>
    <a href="{{ action('HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a> <button type="submit" seq="8" class="btn btn-primary enterseq" id="btnAction">Export Excel</button>  
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
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("checkbox")){
                $("checkbox").filter("[seq='"+dd+"']").select();
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                $("button").filter("[seq='"+dd+"']").focus();
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("label")){
                $("label").filter("[seq='"+dd+"']").focus();
              } else if($(".enterseq").filter("[seq='"+dd+"']").is("a")){
                $("a").filter("[seq='"+dd+"']").focus();
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
          if($(this).attr("name")=="datfr" || $(this).attr("name")=="datto"){
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
            if($(this).attr("name")=="datto"){
              $(".customerfromAutoSelect").focus();
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
        $('.customertoAutoSelect').focus();
        return false;
      } else if(keycode==38) {
        $('input[name="datto"]').select();
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
        $("button").filter("[seq='5']").focus();
        return false;
      } else if(keycode==38) {
        $('.customerfromAutoSelect').select();
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
    $("button[seq='5']").keydown(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode==38){
        $('.customertoAutoSelect').focus();
      }
      return false;
    })
    $("input[name='datfr']").select();
    
    $("input[name='datfr']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
        $(this).datepicker('hide');
    }); 
    $("input[name='datto']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
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

.modal-backdrop.show {
    opacity: 0.05;
}
</style>

@endsection