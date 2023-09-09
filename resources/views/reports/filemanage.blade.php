@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">File Management</h1>
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
  <form id="reportform" method="post" action="{{url('report/filemanage')}}" target="_blank" >
    {{csrf_field()}}
	<div class="row form-group">
	  <div class="col-6">
		<label for="companyid">Company: <span style="color:red;">*</span>:</label>
		<select class="form-control enterseq" seq="4" name="companyid">
		  <option value=""> -- Selection --</option>
		  @if($companylist)
		  @foreach ($companylist as $rcompany)
			<option value="{{$rcompany['id']}}" {{ (($rcompany['b_default']=="Y")?"selected":"") }}>{{$rcompany['companycode']." - ".$rcompany['companyname']}}</option>
		  @endforeach
		  @endif
		</select>
	  </div>
	</div>
    <div class="form-group">
		<div class="row">
			<div class="col-2" id="treecont">
				<div id="tree">

				</div>
				
				<div id="tree2">

				</div>
			</div>
			<div class="col-10">
				<div class="filetitle h1"></div>
				<div class="file-loading">
					<input id="input-iconic" name="input-iconic[]" type="file" multiple>
				</div>
			</div>
		</div>
	</div>
    
    <a href="{{ action('HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a> 
  </form>
    <!-- Modal -->
    <div class="modal fade" id="modalLoading" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <p>Searching in progress.....</p>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('footerjs')
<script src="{{ asset('js/piexif.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/purify.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/fileinput.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/bstreeview.js') }}"></script>
<script type="text/javascript">
	var files = @php echo json_encode($arr_file); @endphp;
	var folder = @php echo json_encode($arr_folder); @endphp;
	$(document).ready(function(evt){
		$('#tree').bstreeview({
			data: folder,
			expandIcon: 'fa fa-angle-down fa-fw',
			collapseIcon: 'fa fa-angle-right fa-fw',
			indent: 0.75,
			parentsMarginLeft: '0.75rem',
			openNodeLinkOnNewTab: true
		});
		$("div.childclick").click(function(evt){
			var ttt = $(this).attr("id").split("/");
			var ssrrr1 = $(this).html().replace("<i class=\"state-icon fa-angle-down fa fa-fw\"></i>","").replace("<i class=\"item-icon fa fa-file-pdf fa-fw\"></i>","").replace("<i class=\"state-icon fa fa-angle-right fa-fw\"></i>","").split("<br>");
			var ssrrr=ssrrr1[0].split("/");
			var sddd=files;
			for(var ss=0; ss<ttt.length;ss++){
				sddd=sddd[ttt[ss]];
			}
			if(sddd[ttt[(ttt.length-1)]]!=undefined){
				if(ssrrr.length>1 && !isNaN(parseInt(ssrrr[1],10))){
					if(sddd[ttt[(ttt.length-1)]][(ssrrr[1]-1)]!=undefined){
						change_filedir(sddd[ttt[(ttt.length-1)]][(ssrrr[1]-1)],$(this).attr("id"),ssrrr[1],ssrrr1[1]);
					}
				} else {
					change_filedir(sddd[ttt[(ttt.length-1)]][0],$(this).attr("id"),ssrrr1[1]);
				}
			}
			var i_idx = $(this).parent().find("div.childclick[aria-level='"+$(this).attr("aria-level")+"']").index($(this));
				
			if(!$(this).next().hasClass("show")){
				$(this).parent().find("div.childclick[aria-level='"+$(this).attr("aria-level")+"']").each(function(ie){
					if(ie!=i_idx){
						//console.log(ie+"!="+i_idx);
						$(this).attr("aria-expanded","false");
						$(this).addClass("collapsed");
						$(this).next().removeClass("show");
					}
				})
			}
		})
		$('#input-iconic').fileinput({
			showRemove: false,
			initialPreviewShowDelete:false,
			initialPreviewShowZoom:false,
			initialPreviewShowDrag:false,
			dropZoneEnabled:false,
			showUpload: false,
			showZoom: false,
			showDrag: false
		});
		$(".file-caption-main").hide();
		$("select[name='companyid']").change(js_company_changed);
		$("select[name='companyid']").change();
	})
	
	function js_company_changed(evt){
		$('#input-iconic').fileinput('destroy');
		$("div.filetitle").html('');
		data1="companyid="+$(this).val();
		$.ajax({
			url:"{{action('ReportFileManageController@getnewtree')}}",
			type:'get',
			dataType: 'json',
			data:data1,
			beforeSend: function(){
				$('#modalLoading').modal('show');
			},
			success: function(json){
				setTimeout(function(){ $("#modalLoading .close").click(); },500);
				$("#treecont").empty();
				$("#treecont").append("<div id='tree'></div>");
				files = json.file;
				folder = json.folder;
				$('#tree').bstreeview({
					data: folder,
					expandIcon: 'fa fa-angle-down fa-fw',
					collapseIcon: 'fa fa-angle-right fa-fw',
					indent: 0.75,
					parentsMarginLeft: '0.75rem',
					openNodeLinkOnNewTab: true
				});
				$("div.childclick").click(function(evt){
					var ttt = $(this).attr("id").split("/");
					var ssrrr1 = $(this).html().replace("<i class=\"state-icon fa-angle-down fa fa-fw\"></i>","").replace("<i class=\"item-icon fa fa-file-pdf fa-fw\"></i>","").replace("<i class=\"state-icon fa fa-angle-right fa-fw\"></i>","").split("<br>");
					var ssrrr=ssrrr1[0].split("/");
					var sddd=files;
					for(var ss=0; ss<ttt.length;ss++){
						sddd=sddd[ttt[ss]];
					}
					if(sddd[ttt[(ttt.length-1)]]!=undefined){
						if(ssrrr.length>1 && !isNaN(parseInt(ssrrr[1],10))) {
							if(sddd[ttt[(ttt.length-1)]][(ssrrr[1]-1)]!=undefined){
								change_filedir(sddd[ttt[(ttt.length-1)]][(ssrrr[1]-1)],$(this).attr("id"),ssrrr[1],ssrrr1[1]);
							}
						} else {
							change_filedir(sddd[ttt[(ttt.length-1)]][0],$(this).attr("id"),ssrrr1[1]);
						}
					}
				})
			}
		});
	}
	
	function change_filedir(data,title,pgc,subtitle){
		$('#input-iconic').fileinput('destroy');
		data1="filedir="+encodeURIComponent(title);
		data1+="&companyid="+$("select[name='companyid']").val();
		$.ajax({
			url:"{{action('ReportFileManageController@getfolderfile')}}",
			type:'get',
			dataType: 'json',
			data:data1,
			success: function(json){
				var datapreview = [];
				var stp = (pgc!=undefined)?((pgc-1)*{{$data["fpf"]}}):0;
				for(var i=0;i<data.length;i++){
					var asdt = data[i].split('/');
					var fname = asdt[(asdt.length-1)];
					var fdir = data[i].replace(fname, "");
					var acap = fname.split('.');
					var fcap = decodeURIComponent(acap[0]);//+"<br>"+json.file[(i+stp)].invoicedate;
					if(json.file[(i+stp)].invoicedate!=undefined){
						fcap += "<br>"+json.file[(i+stp)].invoicedate;
					}
					if(json.file[(i+stp)].companyname!=undefined){
						fcap += "<br><div class='compname'>"+json.file[(i+stp)].companyname+"</div>";
					}
					if(json.file[(i+stp)].canceldate!=undefined){
						dpreview = {type: "pdf", frameClass:"pdfcancel", caption: fcap, filename: fname, url: fdir};
					} else if(json.file[(i+stp)].outstanding>0){
						dpreview = {type: "pdf", frameClass:"pdfoutstanding", caption: fcap, filename: fname, url: fdir};
					} else {
						dpreview = {type: "pdf", caption: fcap, filename: fname, url: fdir};
					}
					datapreview.push(dpreview);
				}
				if(subtitle!=undefined){
					$("div.filetitle").html(title+"<span class=\"filesubtitle\">"+subtitle+"</span>");
				} else {
					$("div.filetitle").html(title);
				}
				$("#input-iconic").fileinput({
					uploadUrl: fdir,
					showRemove: false,
					initialPreviewShowDelete:false,
					initialPreviewShowZoom:false,
					initialPreviewShowDrag:false,
					dropZoneEnabled:false,
					showUpload: false,
					showZoom: false,
					showDrag: false,
					uploadAsync: false,
					minFileCount: 0,
					maxFileCount: 5000,
					overwriteInitial: false,
					initialPreview: data,
					initialPreviewAsData: true, // defaults markup
					initialPreviewFileType: 'pdf', // image is the default and can be overridden in config below
					initialPreviewConfig: datapreview,
					initialPreviewDownloadUrl: fdir+'{filename}',
					preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
					previewFileIconSettings: { // configure your icon file extensions
						'doc': '<i class="fas fa-file-word text-primary"></i>',
						'xls': '<i class="fas fa-file-excel text-success"></i>',
						'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
						'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
						'pdfx': '<i class="fas fa-file-excel text-danger"></i>',
						'zip': '<i class="fas fa-file-archive text-muted"></i>',
						'htm': '<i class="fas fa-file-code text-info"></i>',
						'txt': '<i class="fas fa-file-alt text-info"></i>',
						'mov': '<i class="fas fa-file-video text-warning"></i>',
						'mp3': '<i class="fas fa-file-audio text-warning"></i>',
						'jpg': '<i class="fas fa-file-image text-danger"></i>', 
						'gif': '<i class="fas fa-file-image text-muted"></i>', 
						'png': '<i class="fas fa-file-image text-primary"></i>'    
					},
					previewFileExtSettings: { // configure the logic for determining icon file extensions
						'doc': function(ext) {
							return ext.match(/(doc|docx)$/i);
						},
						'xls': function(ext) {
							return ext.match(/(xls|xlsx)$/i);
						},
						'pdfx': function(ext) {
							return ext.match(/(pdf)$/i);
						},
						'pdf': function(ext) {
							return ext.match(/(pdf)$/i);
						},
						'ppt': function(ext) {
							return ext.match(/(ppt|pptx)$/i);
						},
						'zip': function(ext) {
							return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
						},
						'htm': function(ext) {
							return ext.match(/(htm|html)$/i);
						},
						'txt': function(ext) {
							return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
						},
						'mov': function(ext) {
							return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
						},
						'mp3': function(ext) {
							return ext.match(/(mp3|wav)$/i);
						}
					},
					fileActionSettings: {
						showDrag: false,
					}
				}).on('filesorted', function(e, params) {
					console.log('File sorted params', params);
				}).on('fileuploaded', function(e, params) {
					console.log('File uploaded params', params);
				});
				$(".compname").css("width","213px").css("white-space","break-spaces");
				$("div.pdfcancel div.file-preview-other").find("i").removeClass("fa-file-pdf").addClass("fa-file-excel");
				$("div.pdfcancel").append("<img src=\"../../public/img/cancelled-stamp1.png\" style=\"width:80px; position:absolute;top:0;left:0\">");
				$("div.pdfoutstanding").append("<img src=\"../../public/img/outstanding-stamp1.png\" style=\"width:80px; position:absolute;top:0;left:0\">");
				$(".file-caption-main").hide();
				$("span.filesubtitle span").css("font-size","16px");
				
				$("a.kv-file-download").each(function(i){
					var adln = $(this).attr("download").split("<br>");
					$(this).attr("download",adln[0]);
				})
			}
		})
		
		$(".file-caption-main").hide();
	}
  
</script>
@endsection

@section('topbar')

@endsection

@section('csscontrol')
<link href="{{ asset('css/bstreeview.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/all-krajee.min.css') }}" media="all" rel="stylesheet" type="text/css" />

<style type="text/css">
.file-caption-info {
	font-size:15px;
	font-weight:bold;
	height:140px !important;
	width:auto !important;
}
.file-footer-caption{
	margin-bottom:0px;
}
</style>

@endsection