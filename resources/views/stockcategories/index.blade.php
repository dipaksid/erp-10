@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Stock Category
                @can('ADD STOCK CATEGORY')
                    <a href="{{url('stockcategories/create')}}" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Create
                    </a>
                @endcan
            </h1>
        </div>

        @include('partials/messages')

        <div class="d-flex">
            {{ $stockcategories->links("pagination::bootstrap-4") }}
            @if($stockcategories->hasMorePages() || (isset($searchValue) && $searchValue!=""))
                <form action="{{action('App\Http\Controllers\StockCategoriesController@index')}}">
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
                <th>Category Code</th>
                <th>Description</th>
                <th>Allow Dashboard</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($stockcategories) && $stockcategories->count()>0)
                @foreach ($stockcategories as $irow=> $rcatg)
                    <tr>
                        <th scope="row">{{ $irow+1 }}</th>
                        <td>{{$rcatg->categorycode}}</td>
                        <td>{{$rcatg->description}}</td>
                        <td>{{(($rcatg->isshowdb=="1")?"Yes":"No")}}</td>
                        <td>{{(($rcatg->isactive=="1")?"Yes":"No")}}</td>
                        <td class="text-center col-2">
                            <div class="d-flex">

                                @can('VIEW STOCK CATEGORY')
                                    <a href="{{action('App\Http\Controllers\StockCategoriesController@show',$rcatg->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                @endcan

                                @can('EDIT STOCK CATEGORY')
                                    <a href="{{action('App\Http\Controllers\StockCategoriesController@edit',$rcatg->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                @endcan

                                @can('DELETE STOCK CATEGORY')
                                    <form action="{{action('App\Http\Controllers\StockCategoriesController@destroy', $rcatg->id)}}" method="post" id="deleteForm_{{ $rcatg->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rcatg->id }})">
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
        @include('partials/delete-confirm', ['title' => 'Totalpay APP Services'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
