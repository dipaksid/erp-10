@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Area
                    @can('ADD AREA')
                        <a href="{{url('areas/create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading END -->

            @include('partials/messages')

            <div class="d-flex">
                {{ $area->links("pagination::bootstrap-4") }}
                @if($area->hasMorePages() || (isset($searchValue) && $searchValue!=""))
                    <form action="{{action('App\Http\Controllers\AreasController@index')}}">
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
                    <th>Area Code</th>
                    <th>Description</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($area) && $area->count()>0)
                    @foreach ($area as $irow=> $rarea)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{$rarea->areacode}}</td>
                            <td>{{$rarea->description}}</td>
                            <td>{{(($rarea->isactive=="1")?"Yes":"No")}}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW AREA')
                                        <a href="{{action('App\Http\Controllers\AreasController@show',$rarea->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT AREA')
                                        <a href="{{action('App\Http\Controllers\AreasController@edit',$rarea->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE AREA')
                                        <form action="{{action('App\Http\Controllers\AreasController@destroy', $rarea->id)}}" method="post" id="deleteForm_{{ $rarea->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rarea->id }})">Delete</button>
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
        @include('partials/delete-confirm', ['title' => 'Area'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
