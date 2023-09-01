@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer
            @can('ADD CUSTOMER')
                <a href="{{ url('customers/create') }}" class="btn btn-success">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Create
                </a>
            @endcan
        </h1>
    </div>
    <div style="overflow-x:auto;" class="horizontal-scroll">
        @include('partials/messages')
        <div class="d-flex p-2">
            {{ $customers->links("pagination::bootstrap-4") }}
            @if( $customers->hasMorePages() || $customers->hasPages() || $customers->count()>=0 || (isset($input['searchvalue']) && $input["searchvalue"]!="") )
                <form id="formsrch" action="{{ action('App\Http\Controllers\CustomersController@index') }}">
                    <div class="float-left col-4">
                        <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($input['searchvalue']))?$input['searchvalue']:'') }}">
                    </div>
                    <div class="float-left col-4">
                        <select class="form-control" placeholder="Search Area" name="srch_area">
                            <option value="">Search Area</option>
                            @foreach($area as $rarea)
                                <option value="{{ $rarea->id }}" {{ (($rarea->id==((isset($input['srch_area']))?$input['srch_area']:''))?"selected":"") }}>{{$rarea->areacode}} - {{$rarea->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="float-left col-4">
                        <a class="btn btn-info btn-sm text-white" id="btnpdf" href="javascript:void(0);"><i class="fa fa-pdf"></i>PDF</a>
                        <input type="hidden" name="btnpdf">
                    </div>
                </form>
            @endif
        </div>
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th>Customer Name</th>
                <th>Area</th>
                <th>Customer Code</th>
                <th>Registration No</th>
                <th>Registration No 2</th>
                <th>Contact Person</th>
                <th>Phone 1</th>
                <th>Phone 2</th>
                <th>Email</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($customers) && $customers->count()>0)
                @foreach ($customers as $irow=> $rcus)
                    <tr>
                        <th scope="row">{{ $irow+1 }}</th>
                        <td style="word-wrap:anywhere; font-size:x-small;">{{$rcus->companyname}}</td>
                        <td style="word-wrap:anywhere; font-size:x-small;">{{$rcus->description}}</td>
                        <td>{{ $rcus->companycode }}</td>
                        <td style="word-wrap:anywhere">{{$rcus->registrationno}}</td>
                        <td style="word-wrap:anywhere">{{$rcus->registrationno2}}</td>
                        <td style="word-wrap:anywhere">{{$rcus->contactperson}}</td>
                        <td style="word-wrap:anywhere">{{$rcus->phoneno1}}</td>
                        <td style="word-wrap:anywhere">{{$rcus->phoneno2}}</td>
                        <td style="word-wrap:anywhere">{{$rcus->email}}</td>
                        <td>{{ (($rcus->status=="1")?"ACTIVE":"NOT ACTIVE") }}</td>
                        <td class="text-center col-1 ">
                            <div class="d-flex text-center">
                                @can('VIEW CUSTOMER')
                                    <a href="{{ action('App\Http\Controllers\CustomersController@show',$rcus->id) }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}"  class="btn btn-primary btn-sm"><i class="fa fa-clone"></i></a>&nbsp;
                                @endcan
                                @can('EDIT CUSTOMER')
                                    <a href="{{action('App\Http\Controllers\CustomersController@edit',$rcus->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}"  class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp;
                                @endcan
                                @can('DELETE CUSTOMER')
                                    <form action="{{action('App\Http\Controllers\CustomersController@destroy', $rcus->id)}}" method="post" id="deleteForm_{{ $rcus->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="showConfirmDeleteModal({{ $rcus->id }})">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="12">No Record Found</td>
                </tr>
            @endif
            </tbody>
        </table>
        {{ $customers->links("pagination::bootstrap-4") }}
    </div>
    </div>
    <!-- DELETE confirm Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this customer?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeModalBackdrop()">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
    <script type="text/javascript" type="module">
        $(document).ready(function(evt){
            $("select[name='srch_area']").change(function(evt){
                $("#formsrch").submit();
            })
            if("{{((isset($pdffile))?$pdffile:'')}}"!=""){
                window.open("{{((isset($pdffile))?$pdffile:'')}}");
            }
            $("a#btnpdf").click(function(evt){
                $("input[name='btnpdf']").val('pdf');
                $("#formsrch").submit();
            })
        })
    </script>
@endsection
