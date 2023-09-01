@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 text-gray-800">
                    Permissions
                    @can('ADD ROLE')
                        <a href="{{ url('permissions/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->
            @include('partials/messages')

            <div class="d-flex p-2">
                {{ $permissions->links("pagination::bootstrap-4") }}
                @if($permissions->hasMorePages() || (isset($filters['searchvalue']) && $filters["searchvalue"]!=""))
                    <form action="{{ action('App\Http\Controllers\PermissionsController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($filters['searchvalue'])) ? $filters['searchvalue'] : old('searchvalue') ) }}">
                        </div>
                    </form>
                @endif
            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($permissions) && count($permissions)>0)
                    @foreach ($permissions as $irow=> $rpermission)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{$rpermission->name}}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW PERMISSION')
                                        <a href="{{ action('App\Http\Controllers\PermissionsController@show',$rpermission->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan
                                    @can('EDIT PERMISSION')
                                        <a href="{{ action('App\Http\Controllers\PermissionsController@edit',$rpermission->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan
                                    @can('DELETE PERMISSION')
                                        <form action="{{ action('App\Http\Controllers\PermissionsController@destroy', $rpermission->id)}}" method="post" id="deleteForm_{{ $rpermission->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="showConfirmDeleteModal({{ $rpermission->id }})">
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
                        <td class="text-center" colspan="4">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('partials/delete-confirm')
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
