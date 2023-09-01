@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="">
        <!-- Page Heading Start-->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer Groups
                @can('ADD CUSTOMER GROUP')
                    <a href="{{ url('customer-groups/create') }}" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i> Create
                    </a>
                @endcan
            </h1>
        </div>
        <!-- Page Heading End-->

        @include('partials/messages')

        <div class="d-flex p-2">
            {{ $customerGroups->links("pagination::bootstrap-4") }}
            @if( $customerGroups->hasMorePages() || (isset($filters['searchvalue']) && $filters["searchvalue"]!="") )
                <form action="{{ action('App\Http\Controllers\CustomerGroupsController@index')}} ">
                    <div class="col-12">
                        <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($filters['searchvalue']))?$filters['searchvalue']:'')}}">
                    </div>
                </form>
            @endif
        </div>

        <table class="table table-striped horizontal-table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th>Group Code</th>
                <th>Description</th>
                <th>System ID</th>
                <th>Bill From Company</th>
                <th>Customers</th>
                <th>CFG</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($customerGroups) && $customerGroups->count() > 0)
                @foreach ($customerGroups as $irow => $rgroup)
                    <tr>
                        <th scope="row">{{ $irow+1 }}</th>
                        <td>{{ $rgroup->code }}</td>
                        <td>{{ $rgroup->name }}</td>
                        <td>{{ $rgroup->system }}</td>
                        <td>{{ $rgroup->companyfrom }}</td>
                        <td>{{ $rgroup->company }}</td>
                        <td>{!! $rgroup->cfg !!}</td>
                        <td class="text-center col-2">
                            <div class="d-flex">
                                @can('VIEW CUSTOMER GROUP')
                                    <a href="{{ action('App\Http\Controllers\CustomerGroupsController@show', $rgroup->id) }}?searchvalue={{ ((isset($filters['searchvalue'])) ? $filters['searchvalue'] : '') }}&page={{ ((isset($filters['page'])) ? $filters['page'] : '') }}"  class="btn btn-primary">View</a>&nbsp;
                                @endcan
                                @can('EDIT CUSTOMER GROUP')
                                    <a href="{{ action('App\Http\Controllers\CustomerGroupsController@edit', $rgroup->id) }}?searchvalue={{((isset($filters['searchvalue'])) ? $filters['searchvalue'] : '') }}&page={{ ((isset($filters['page'])) ? $filters['page'] : '') }}"  class="btn btn-primary">Edit</a>&nbsp;
                                @endcan
                                @can('DELETE CUSTOMER GROUP')
                                    <form action="{{action('App\Http\Controllers\CustomerGroupsController@destroy', $rgroup->id)}}" method="post" id="deleteForm_{{ $rgroup->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="showConfirmDeleteModal({{ $rgroup->id }})">
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
    @include('partials/delete-confirm', ['title' => 'Customer Group'])
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        function js_openfile(file){
            window.open(file,'downloadfile');
        }
    </script>
@endsection
