@extends('layouts.app')


@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 text-gray-800">Users
                    @can('ADD USER')
                        <a href="{{ url('users/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->
            @include('partials.messages')
            <div class="row">
                {{ $users->links("pagination::bootstrap-4") }}
                @if($users->hasMorePages() || (isset($filters['searchvalue']) && $filters["searchvalue"]!=""))
                    <form action="{{ action('App\Http\Controllers\UsersController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($filters['searchvalue']))?$filters['searchvalue']:'')}}">
                        </div>
                    </form>
                @endif
            </div>
            <table class="table table-striped mb-4">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($users) && $users->count()>0)
                    @foreach ($users as $irow=> $ruser)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $ruser->name }}</td>
                            <td>{{ $ruser->email }}</td>
                            <td> {{ $ruser->getRoleNames()->first() }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">

                                    @can('VIEW USER')
                                        <a href="{{ action('App\Http\Controllers\UsersController@show',$ruser->id) }}"  class="btn btn-primary">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT USER')
                                        <a href="{{ action('App\Http\Controllers\UsersController@edit',$ruser->id) }}"  class="btn btn-primary">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE USER')
                                        <form action="{{action('App\Http\Controllers\UsersController@destroy', $ruser->id)}}" method="post" id="deleteForm_{{ $ruser->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="showConfirmDeleteModal(event, {{ $ruser->id }})">
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
        @include('partials/delete-confirm', ['title' => 'Users'])
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
