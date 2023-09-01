@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Bank
                    @can('ADD BANK')
                        <a href="{{url('banks/create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <div class="d-flex">
                {{ $banks->links("pagination::bootstrap-4") }}
                @if($banks->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                    <form action="{{action('App\Http\Controllers\BanksController@index')}}">
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
                    <th>Bank Code</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($banks) && $banks->count()>0)
                    @foreach ($banks as $irow=> $rbank)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rbank->code }}</td>
                            <td>{{ $rbank->name }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW BANK')
                                        <a href="{{action('App\Http\Controllers\BanksController@show',$rbank->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT BANK')
                                        <a href="{{action('App\Http\Controllers\BanksController@edit',$rbank->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE BANK')
                                        <form action="{{action('App\Http\Controllers\BanksController@destroy', $rbank->id)}}" method="post" id="deleteForm_{{ $rbank->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rbank->id }})">
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
                        <td class="text-center" colspan="5">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('partials/delete-confirm', ['title' => 'Bank'])
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
