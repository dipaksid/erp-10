@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">UOMs
                    @can('ADD UOMS')
                        <a href="{{url('uoms/create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create
                        </a>
                    @endcan
                </h1>
                <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>

            @include('partials/messages')

            <div class="d-flex">
                {{ $uoms->links("pagination::bootstrap-4") }}
                @if($uoms->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                    <form action="{{action('App\Http\Controllers\UomsController@index')}}">
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
                    <th>Stock Code</th>
                    <th>UOMs Code</th>
                    <th>Description</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($uoms) && $uoms->count()>0)
                    @foreach ($uoms as $irow=> $ruom)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{$ruom->stockcode}}</td>
                            <td>{{$ruom->uomcode}}</td>
                            <td>{{$ruom->description}}</td>
                            <td>{{(($ruom->isactive=="1")?"Yes":"No")}}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">

                                    @can('VIEW STOCK CATEGORY')
                                        <a href="{{action('App\Http\Controllers\UomsController@show',$ruom->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT STOCK CATEGORY')
                                        <a href="{{action('App\Http\Controllers\UomsController@edit',$ruom->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE STOCK CATEGORY')
                                        <form action="{{action('App\Http\Controllers\UomsController@destroy', $ruom->id)}}" method="post" id="deleteForm_{{ $ruom->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $ruom->id }})">
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
                        <td class="text-center" colspan="6">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('partials/delete-confirm', ['title' => 'Umos'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
