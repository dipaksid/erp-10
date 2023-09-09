@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Serialization Category Report</h1>
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
  <form id="reportform" method="post" action="{{url('report/serialcategory')}}" target="_blank" >
    {{csrf_field()}}
    <div class="row form-group">
      <div class="col-9">
		<div class="row form-check">
		  <div class="col-9">
			<label>Serialization Category:</label>
			<div class="col-6 form-check-label">
			@foreach($data["customercategory"] as $ss => $category)
			  <input type="checkbox" class="form-check-input" name="chkCategory[]" value="{{$category->id}}" checked>
			  {{$category->categorycode}}<br>
			@endforeach
			</div>
			
		  </div>
		</div>
      </div>
    </div>
    <a href="{{ action('HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a> <button type="submit"  class="btn btn-primary" id="btnAction">Print</button>  
  </form>
</div>
@endsection

@section('footerjs')
<script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function(evt){
    
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