@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Training Form</h1>
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
  @if(\Session::has('danger'))
      <div class="alert alert-danger">
          {{\Session::get('danger')}}
      </div>
  @endif
  <form id="addtrainingform" method="post" action="{{url('trainingform')}}" >
    {{csrf_field()}}
    <input type="hidden" name="printdo">
    <input type="hidden" name="salesnote">
    <input type="hidden" name="printnote">
    <input type="hidden" name="salesnotelist">
    <div class="row form-group">
      <div class="col-3">
        <label for="title">System:</label>
        <select class="form-control enterseq" readonly seq="1" name="systemcod" id="systemcod">
          <option value=""> -- Selection --</option>
          @foreach($data['customercategory'] as $ckey => $rowcat)
            <option {{(($trainingform->systemcod == $rowcat['categorycode'])?"selected":"")}} value="{{$rowcat['categorycode']}}">{{$rowcat['categorycode']}} - {{$rowcat['description']}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-3">
        <label for="title">Title:</label>
        <input type="text" class="form-control enterseq" readonly seq="2" name="form_title" value="{{$trainingform->form_title}}" id="form_title">

      </div>
    </div>

  		<table class="table table-hover" id="dragdroptable">
  			<thead class="thead-light">
  				<tr>
  				  <th scope="col">#</th>
            <th>No</th>
  				  <th>Particular</th>
            <th></th>
  				</tr>
  			</thead>
  			<tbody>
  				@if(isset($trainingdetail) && $trainingdetail->count()>0)
  					@foreach ($trainingdetail as $iseqrow=> $rowdetail)
            @php $view_flag = 0; @endphp
              @if($detailextra)
                @foreach($detailextra as $dkey => $extra)
                  @if($extra->detail_id == $rowdetail->id)
                    @php $view_flag = 1; @endphp
                  @endif
                @endforeach
              @endif
  					<tr id="{{$rowdetail->seq }}">
  						<th scope="row">{{ $iseqrow+1 }}</th>
  						<td>{{$rowdetail->no}}</td>
  						<td>{{$rowdetail->particular}}</td>
              @if($view_flag == 1)
                <td><button type="button" onclick="getClick({{$rowdetail->id}})" class="btn btn-primary" class="button">Detail</button></td>
              @else
                <td></td>
              @endif

  					</tr>
  					@endforeach
  				@else
  					<tr>
  						<td class="text-center" colspan="5">No Record Found</td>
  					</tr>
  				@endif
  			</tbody>
  		</table>

    <a href="{{ action('TrainingFormController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
  </form>

  <div class="modal fade" id="particularDetailModal" tabindex="-1" role="dialog" aria-labelledby="particularDetailModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="particularDetailModal">Add Details</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>

			</div>
			<div class="modal-body">
			  <div class="row pb-1">
				<div class="col-6 row">
				  <input type="hidden" class="form-control col-10" name="title_id" id="title_id" value="">
				</div>
			  </div>
				<div class="form-group">
          <table class="table table-hover" id="dragdroptable2">
      			<thead class="thead-light">
      				<tr>
      				  <th scope="col">#</th>
                <th>No</th>
      				  <th>Particular</th>
      				</tr>
      			</thead>
      			<tbody id="detailbody">

      			</tbody>
      		</table>
				</div>
        <div class="row">
					<div class="col-12 text-right">
						<button data-dismiss="modal" class="btn btn-secondary btn-xs" id="btnBack">Close</button>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
  <!-- -->
</div>
@endsection

@section('footerjs')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script type="text/javascript">
var id = "{{$id}}";
var fixHelperModified = function(e, tr) {
	var $originals = tr.children();
	var $helper = tr.clone();
	$helper.children().each(function(index) {
		$(this).width($originals.eq(index).width())
	});
	return $helper;
},
updateIndex = function(e, ui) {
	js_update_seq(ui.item[0].id,ui.item[0].rowIndex);
	$('#dragdroptable td.index', ui.item.parent()).each(function (i) {
		$(this).html(i+1);
	});
};
updateIndexs = function(e, ui) {
  js_update_seq2(ui.item[0].id,ui.item[0].rowIndex);
  $('#dragdroptable2 td.index', ui.item.parent()).each(function (i) {
    $(this).html(i+1);
  });
};
$("#dragdroptable tbody").sortable({
	helper: fixHelperModified,
	stop: updateIndex
}).disableSelection();

$("#dragdroptable tbody").sortable({
	distance: 5,
	delay: 100,
	opacity: 0.6,
	cursor: 'move',
    over: function(event,ui){
        $('.ui-sortable-placeholder').addClass('dhover');
    },
    out: function(event,ui){
        $('.ui-sortable-placeholder').removeClass('dhover');
    },
	update: function() {
	}
});

function js_update_seq(fromseq,toseq){
		data="fromseq="+fromseq;
    data+="&toseq="+toseq;
		data+="&id="+id;
    $.ajax({
      url:"{{action('TrainingFormController@updseq')}}",
      type:'post',
      dataType: 'json',
      data:data,
      success: function(json){
        if(json.msg=="success"){
			$("#dragdroptable tbody").empty();
			if(Object.keys(json.datalist).length>0){
				var tr = "";
				$.each(json.datalist,function(i,v){
          var show = 0;
          if(v.no == '' || v.no == null){
            var no = '';
          } else {
            var no = v.no;
          }
					tr += "<tr id=\""+v.seq+"\">";
					tr += "<th scope=\"row\">"+v.seq+"</th>";
					tr += "<td>"+no+"</td>";
					tr += "<td>"+v.particular+"</td>";
          if(json.sublist){
            $.each(json.sublist,function(j,k){
              if(k.detail_id == v.id){
                show = 1;
              }
            })
          }
          if(show == 1){
            tr +="<td><button type=\"button\" onclick=\"getClick("+v.id+")\" class=\"btn btn-primary\" class=\"button\">Detail</button></td>";
          } else {
            tr +="<td></td>";
          }
					tr += "</tr>";
				})
				$("#dragdroptable tbody").append(tr);
			}
		}
      }
    })
}

function js_update_seq2(fromseq,toseq){
    var titleid = document.getElementById("title_id").value;
		data="fromseq="+fromseq;
    data+="&toseq="+toseq;
		data+="&id="+titleid;
    $.ajax({
      url:"{{action('TrainingFormController@updseq2')}}",
      type:'post',
      dataType: 'json',
      data:data,
      success: function(json){
        if(json.msg=="success"){
			$("#detailbody").empty();
			if(Object.keys(json.datalist).length>0){
				var tr = "";
				$.each(json.datalist,function(i,v){
          var show = 0;
          if(v.no == '' || v.no == null){
            var no = '';
          } else {
            var no = v.no;
          }
					tr += "<tr id=\""+v.seq+"\">";
					tr += "<th scope=\"row\">"+v.seq+"</th>";
					tr += "<td>"+no+"</td>";
					tr += "<td>"+v.particular+"</td>";
					tr += "</tr>";
				})
				$("#detailbody").append(tr);
			}
		}
      }
    })
}
function getClick(getid){
  document.getElementById("title_id").value = getid;
  $("#particularDetailModal").modal("show");
  getdetailTable(getid);
}
function getdetailTable(getid){
  data2="id="+getid;
  $.ajax({
    url:"{{action('TrainingFormController@detailList')}}",
    type:'get',
    dataType: 'json',
    data:data2,
    success: function(json){
      if(json.msg=="success"){
        $("#detailbody").empty();
        if(Object.keys(json.datalist).length>0){
          var tr = "";
          $.each(json.datalist,function(i,v){
            var show = 0;
            if(v.no == '' || v.no == null){
              var no = '';
            } else {
              var no = v.no;
            }
            tr += "<tr id=\""+v.seq+"\">";
            tr += "<th scope=\"row\">"+v.seq+"</th>";
            tr += "<td>"+no+"</td>";
            tr += "<td>"+v.particular+"</td>";
            tr += "</tr>";
          })
          $("#detailbody").append(tr);
        }
      }
    }
  })
}
$("#dragdroptable2 tbody").sortable({
  helper: fixHelperModified,
  stop: updateIndexs
}).disableSelection();

$("#dragdroptable2 tbody").sortable({
  distance: 5,
  delay: 100,
  opacity: 0.6,
  cursor: 'move',
    over: function(event,ui){
        $('.ui-sortable-placeholder').addClass('dhover');
    },
    out: function(event,ui){
        $('.ui-sortable-placeholder').removeClass('dhover');
    },
  update: function() {
  }
});

</script>
@endsection

@section('topbar')

<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

</form>

@endsection

@section('csscontrol')
<style type="text/css">
#dragdroptable td:hover{
	cursor:move;
}
#dragdroptable2 td:hover{
	cursor:move;
}
.dhover{
	border:5px solid red;
}
</style>
@endsection
