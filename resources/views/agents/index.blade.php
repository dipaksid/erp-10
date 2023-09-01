@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Agents
                    @can('ADD AGENT')
                        <a href="{{ url('agents/create') }}" class="btn btn-success fas fa-plus">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <div class="row">
                {{ $agents->links("pagination::bootstrap-4") }}
                @if($agents->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                    <form action="{{action('App\Http\Controllers\AgentsController@index')}}">
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
                    <th>Agent Code</th>
                    <th>Name</th>
                    <th>Area</th>
                    <th>Commission Rate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($agents) && $agents->count()>0)
                    @foreach ($agents as $irow=> $ragent)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $ragent->agentcode }}</td>
                            <td>{{ $ragent->name }}</td>
                            <td>{{ $ragent->description }}</td>
                            <td>{{ $ragent->commrate }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW AGENT')
                                        <a href="{{action('App\Http\Controllers\AgentsController@show',$ragent->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT AGENT')
                                        <a href="{{action('App\Http\Controllers\AgentsController@edit',$ragent->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE AGENT')
                                        <form action="{{action('App\Http\Controllers\AgentsController@destroy', $ragent->id)}}" method="post" id="deleteForm_{{ $ragent->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $ragent->id }})">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="6">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('partials/delete-confirm', ['title' => 'Agent'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
