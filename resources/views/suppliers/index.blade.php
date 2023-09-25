@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Suppliers
                @can('ADD SUPPLIER')
                    <a href="{{ url('supplier/create') }}" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Create
                    </a>
                @endcan
            </h1>
        </div>
        <!-- Page Heading END -->

        @include('partials/messages')

        <div class="d-flex pb-2">
            {{ $suppliers->links("pagination::bootstrap-4") }}
            @if($suppliers->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                <form action="{{ action('App\Http\Controllers\SuppliersController@index') }}">
                    <div class="col-12">
                        <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($searchValue)) ? $searchValue : '')}}">
                    </div>
                </form>
            @endif
        </div>

        <div class="table-responsive-xxl">
            <table class="table w-100">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Supplier Name</th>
                    <th>Area</th>
                    <th>Supplier Code</th>
                    <th>Registration No</th>
                    <th>Registration No 2</th>
                    <th>Contact Person</th>
                    <th>Phone 1</th>
                    <th>Phone 2</th>
                    <th>Email</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($suppliers) && $suppliers->count()>0)
                    @foreach ($suppliers as $irow=> $rsup)
                        <tr>
                            <td>{{ $irow+1 }}</td>
                            <td>{{$rsup->companyname}}</td>
                            <td>{{$rsup->description}}</td>
                            <td>{{$rsup->companycode}}</td>
                            <td>{{$rsup->registrationno}}</td>
                            <td>{{$rsup->registrationno2}}</td>
                            <td>{{$rsup->contactperson}}</td>
                            <td>{{$rsup->phoneno1}}</td>
                            <td>{{$rsup->phoneno2}}</td>
                            <td>{{$rsup->email}}</td>
                            <td class="text-center">
                                <div class="d-flex">
                                    @can('VIEW SUPPLIER')
                                        <a href="{{action('App\Http\Controllers\SuppliersController@show',$rsup->id)}}?searchvalue={{((isset($searchValue))?$searchValue:'')}}&page={{((isset($page))?$page:'')}}"  class="btn btn-primary btn-sm">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT SUPPLIER')
                                        <a href="{{action('App\Http\Controllers\SuppliersController@edit',$rsup->id)}}?searchvalue={{((isset($searchValue))?$searchValue:'')}}&page={{((isset($page))?$page:'')}}"  class="btn btn-primary btn-sm">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE SUPPLIER')
                                        <form action="{{action('App\Http\Controllers\SuppliersController@destroy', $rsup->id)}}" method="post" id="deleteForm_{{ $rsup->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="showConfirmDeleteModal(event, {{ $rsup->id }})" >
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
                        <td class="text-center" colspan="11">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('partials/delete-confirm', ['title' => 'Supplier'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
