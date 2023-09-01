@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Stock Category</h1>
            </div>

            @include('partials/messages')

            <form method="post" >
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Category Code:</label>
                        <input type="text" class="form-control" name="name" value="{{$stockcategory->categorycode}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{$stockcategory->description}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Allow to Prompt At Dashboard:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isshowdb" name="isshowdb" {{(($stockcategory->isshowdb=='1')?"checked":"")}} disabled >
                            <label class="custom-control-label" for="isshowdb"></label>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isactive" name="isactive" {{(($stockcategory->isactive=='1')?"checked":"")}} disabled >
                            <label class="custom-control-label" for="isactive"></label>
                        </div>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\StockCategoriesController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>

        </div>
    </div>
@endsection
