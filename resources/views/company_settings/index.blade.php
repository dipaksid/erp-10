@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Company Settings
                @can('ADD COMPANY')
                    <a href="{{ url('company_settings/create') }}" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Create
                    </a>
                @endcan
            </h1>
        </div>
        <div class="">
        @include('partials/messages')
        <div class="row pt-2 pb-2 w-50">
            {{ $companySettings->links("pagination::bootstrap-4") }}
            @if($companySettings->hasMorePages() || (isset($filters['searchvalue']) && $filters["searchvalue"] != ""))
                <form action="{{ action('App\Http\Controllers\CompanySettingsController@index') }}">
                    <div class="col-12 ml-0">
                        <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($filters['searchvalue'])) ? $filters['searchvalue'] : '')}}">
                    </div>
                </form>
            @endif
        </div>
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Company Code</th>
                    <th>Company Name</th>
                    <th>Registration Code 1</th>
                    <th>Registration Code 2</th>
                    <th>Contact Person</th>
                    <th>Contact No</th>
                    <th>Default</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($companySettings) && $companySettings->count()>0)
                    @foreach ($companySettings as $irow=> $rcompanySettings)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rcompanySettings->companycode }}</td>
                            <td>{{ $rcompanySettings->companyname }}</td>
                            <td>{{ $rcompanySettings->registrationno }}</td>
                            <td>{{ $rcompanySettings->registrationno2 }}</td>
                            <td>{{ $rcompanySettings->contactperson }}</td>
                            <td>{{ $rcompanySettings->phoneno1 }}</td>
                            <td>{{ $rcompanySettings->b_default }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex justify-content-center align-items-center">
                                    @can('VIEW COMPANY SETTINGS')
                                        <a href="{{ action('App\Http\Controllers\CompanySettingsController@show',$rcompanySettings->id) }}" class="btn btn-primary">View</a>&nbsp;
                                    @endcan
                                    @can('EDIT COMPANY SETTINGS')
                                        <a href="{{ action('App\Http\Controllers\CompanySettingsController@edit',$rcompanySettings->id) }}" class="btn btn-primary">Edit</a>&nbsp;
                                    @endcan
                                    @can('DELETE COMPANY SETTINGS')
                                        <form class="deletefrom" action="{{ action('App\Http\Controllers\CompanySettingsController@destroy', $rcompanySettings->id)}}" method="post" id="deleteForm_{{ $rcompanySettings->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" id="delete_id" value="{{ $rcompanySettings->id }}" />
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="showConfirmDeleteModal({{ $rcompanySettings->id }})">
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
                        <td class="text-center" colspan="8">No Record Found</td>
                    </tr>
                @endif
            </tbody>
            </table>
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
                    Are you sure you want to delete this company setting?
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



