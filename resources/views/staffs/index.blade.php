@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Staff
                    @can('ADD STAFF')
                        <a href="{{url('staffs/create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <div class="d-flex">
                {{ $staffs->links("pagination::bootstrap-4") }}
                @if($staffs->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                    <form action="{{ action('App\Http\Controllers\StaffsController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($searchValue)) ? $searchValue : '') }}">
                        </div>
                    </form>
                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Staff Code</th>
                    <th>Name</th>
                    <th>Commission Rate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($staffs) && $staffs->count()>0)
                    @foreach ($staffs as $irow=> $rstaff)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rstaff->staffcode }}</td>
                            <td>{{ $rstaff->name }}</td>
                            <td>{{ $rstaff->commrate }}</td>
                            <td class="text-center col-2">
                                <div class="row">
                                    @can('VIEW STAFF')
                                        <a href="{{ action('App\Http\Controllers\StaffsController@show', $rstaff->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT STAFF')
                                        <a href="{{ action('App\Http\Controllers\StaffsController@edit',$rstaff->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE STAFF')
                                        <form action="{{ action('App\Http\Controllers\StaffsController@destroy', $rstaff->id)}}" method="post" id="deleteForm_{{ $rstaff->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rstaff->id }})">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('partials/delete-confirm', ['title' => 'Staffs'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection


