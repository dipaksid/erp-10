@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Print Customer/Supplier Sticker</h1>
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
  <form id="reportform" method="post" action="{{url('report/sticker')}}" >
    {{csrf_field()}}
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Customer/Supplier:</label>
        <select class="form-control enterseq" seq="1" name="customer_supplier">
          <option value="C">Customer</option>
          <option value="S">Supplier</option>
        </select>
      </div>
      <div class="col-3">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Code:</label>
        <span id="idCode"><input type="text" class="form-control" name="code" id="code" seq="2" value=""/></span>
      </div>
      <div class="col-3">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Copies :</label>
        <input type="number" class="form-control" name="copies" id="copies" seq="3" on value="1"/>
      </div>
      <div class="col-3">
      </div>
    </div>
    <a href="{{ action('HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a> <button type="button" seq="4" class="btn btn-primary enterseq" id="btnAction">Print</button>  
  </form>
</div>
@endsection

@section('footerjs')
<script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	var searchtrigger=false;
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
          }
          return false; 
        }
      })
    })
	$("#btnAction").keydown(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
        switch(keycode) {
          case 13:
			//$(this).click();
			break;
		}
	})
	$("#btnAction").bind("click",function(evt){
		if($("input[name='code']").val().length>4){
			data="customer_supplier="+$("select[name='customer_supplier']").val();
			data+="&code="+$("input[name='code']").val();
			data+="&copies="+$("#copies").val();
			var confirmprint="";
			if($("select[name='customer_supplier']").val()=="C"){
				confirmprint=confirm("Print Customer Sticker Code : "+$("input[name='code']").val())
			} else {
				confirmprint=confirm("Print Supplier Sticker Code : "+$("input[name='code']").val())
			}
			if(confirmprint){
				$.ajax({
					type:'post',
					dataType: 'json',
					data:data,
					success: function(json){
						//if(json.filename!=undefined){
						//	printfile("http://192.168.42.238/printfile/print.php","Sticker",'stkerid',json.filename);
						//}
						alert("Total "+json.count+" sticker printed!");
						window.location = "{{ action('ReportStickerController@index') }}";
						return false;  
					}
				})
			}
		} else {
			alert("Code is compulsory feild. At least key in 5 digit Code for print sticker.");
		}
	})
    $("select[name='customer_supplier']").bind("change",function(evt){
      js_customer_supplier_change($(this).val());
    })
    $("select[name='customer_supplier']").change();
  })
  function js_customer_supplier_change(cval){
    if(cval=="C"){
      var inputcode = $("<input class='form-control custAutoSelect overflow-ellipsis' name='code' placeholder='Customer search' data-url=\"{{ action('ReportController@customerlist') }}\" autocomplete='off'></select>");
      $("#idCode").html(inputcode);
      $('.custAutoSelect').autoComplete({minLength:2,
        events: {
            searchPost: function (resultFromServer) {
                setTimeout(function(){
					$('.custAutoSelect').focus();
					searchtrigger=true;
                   $('.custAutoSelect').next().find('a').eq(0).addClass("active");
                },100)
                return resultFromServer;
            }
        }
      });
      $('.custAutoSelect').keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode==13){
			if(searchtrigger) {
				searchtrigger=false;
				$('.custAutoSelect').change();
			}
          return false;
        }
      })
      $('.custAutoSelect').on('change', function (e, datum) {
        setTimeout(function(){ 
          if($('.custAutoSelect').val()==""){
            $('.custAutoSelect').focus();
          } else {
            var ss = $('.custAutoSelect').val().split(" = ");
            $('.custAutoSelect').val(ss[0]);
			if(!searchtrigger) {
				$("#btnAction").focus();
			}
          }
        },300);
        return false;
      });
	  $('.custAutoSelect').on('autocomplete.select', function (e, datum) {
			$(this).change();
			return false;
	  })
      $("input[name='code']").keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        switch(keycode) {
          case 13:
            $(this).val($(this).val().toUpperCase());
          break;
        }
      })
    } else if(cval=="S"){
      var inputcode = $("<input class='form-control suppAutoSelect overflow-ellipsis' name='code' placeholder='Supplier search' data-url=\"{{ action('ReportController@supplierlist') }}\" autocomplete='off'></select>");
      $("#idCode").html(inputcode);
      $('.suppAutoSelect').autoComplete({minLength:2,
        events: {
            searchPost: function (resultFromServer) {
				setTimeout(function(){
					$('.suppAutoSelect').focus();
					searchtrigger=true;
                   $('.suppAutoSelect').next().find('a').eq(0).addClass("active");
                },100)
                return resultFromServer;
            }
        }
      });
      $('.suppAutoSelect').keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode==13){
			if(searchtrigger) {
				searchtrigger=false;
				$('.suppAutoSelect').change();
			}
          return false;
        }
      })
      $('.suppAutoSelect').on('change', function (e, datum) {
        setTimeout(function(){ 
          if($('.suppAutoSelect').val()==""){
            $('.suppAutoSelect').focus();
          } else {
            var ss = $('.suppAutoSelect').val().split(" = ");
            $('.suppAutoSelect').val(ss[0]);
			if(!searchtrigger) {
				$("#btnAction").focus();
			}
          }
        },300);
        return false;
      });
      $("input[name='code']").keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        switch(keycode) {
          case 13:
            $(this).val($(this).val().toUpperCase());
          break;
        }
      })
    }
  }
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