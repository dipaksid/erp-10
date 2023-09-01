@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 text-gray-800">
                    Roles
                    @can('ADD ROLE')
                        <a href="{{ url('roles/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')
            <div class="row">
                {{ $roles->links("pagination::bootstrap-4") }}

                @if( $roles->hasMorePages() || (isset($filters['searchvalue']) && $filters["searchvalue"]!=""))
                    <form action="{{action('RoleController@index')}}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($filters['searchvalue'])) ? $filters['searchvalue'] : '') }}">
                        </div>
                    </form>
                @endif
            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if( isset($roles) && $roles->count() > 0 )
                    @foreach ($roles as $irow=> $rrole)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rrole->name }}</td>
                            <td>{{ $rrole->permissionname }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW ROLE')
                                        <a href="{{ action('App\Http\Controllers\RolesController@show',$rrole->id) }}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan
                                    @can('EDIT ROLE')
                                        <a href="{{ action('App\Http\Controllers\RolesController@edit',$rrole->id) }}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan
                                    @can('DELETE ROLE')
                                        <form action="{{ action('App\Http\Controllers\RolesController@destroy', $rrole->id) }}" method="post" id="deleteForm_{{ $rrole->id }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="showConfirmDeleteModal({{ $rrole->id }})">
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
            <div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this role?
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
@endsection
