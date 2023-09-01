@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Category
                    @can('ADD CUSTOMER CATEGORY')
                        <a href="{{ url('customercategory/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <div class="d-flex">
                {{ $categories->links("pagination::bootstrap-4") }}
                @if($categories->hasMorePages() || (isset($searchValue) && $searchValue!=""))
                    <form action="{{ action('App\Http\Controllers\CustomerCategoriesController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($searchValue))?$searchValue:'')}}">
                        </div>
                    </form>
                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Category Code</th>
                    <th>Description</th>
                    <th>Last Running Serial Number</th>
                    <th>System Version</th>
                    <th>Allow Remark</th>
                    <th>Mobile Application</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($categories) && $categories->count()>0)
                    @foreach ($categories as $irow=> $rcategory)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rcategory->categorycode }}</td>
                            <td>{{ $rcategory->description }}</td>
                            <td>{{ $rcategory->lastrunno }}</td>
                            <td>{{ $rcategory->version }}</td>
                            <td>{{ $rcategory->b_rmk }}</td>
                            <td>{{ $rcategory->b_mobapp }}</td>
                            <td class="text-center col-3">
                                <div class="d-flex align-items-center">
                                    @can('VIEW CUSTOMER CATEGORY')
                                        <a href="{{ action('App\Http\Controllers\CustomerCategoriesController@show',$rcategory->id)}}?searchvalue={{((isset($searchValue))?$searchValue:'')}}&page={{((isset($page))?$page:'') }}" class="btn btn-primary btn-sm mx-1">View</a>
                                    @endcan

                                    @can('EDIT CUSTOMER CATEGORY')
                                        <a href="{{ action('App\Http\Controllers\CustomerCategoriesController@edit',$rcategory->id)}}?searchvalue={{((isset($searchValue))?$searchValue:'')}}&page={{((isset($page))?$page:'') }}" class="btn btn-primary btn-sm mx-1">Edit</a>
                                    @endcan

                                    @can('DELETE CUSTOMER CATEGORY')
                                        <form action="{{ action('App\Http\Controllers\CustomerCategoriesController@destroy', $rcategory->id) }}" method="post" id="deleteForm_{{ $rcategory->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm mx-1" type="submit" onclick="showConfirmDeleteModal(event, {{ $rcategory->id }})">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan

                                    @can('UPLOAD SYSTEM FILE')
                                        <a href="{{ route('customercategory.uploadsystem', $rcategory->id)}}?searchvalue={{((isset($searchValue))?$searchValue:'')}}&page={{((isset($page))?$page:'') }}" class="btn btn-primary btn-sm mx-1" style="width:150px;">
                                            Upload System File
                                        </a>
                                    @endcan
                                </div>
                            </td>


                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="7">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('partials/delete-confirm', ['title' => 'Customer Category'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
