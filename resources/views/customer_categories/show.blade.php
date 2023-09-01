@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Category</h1>
            </div>
            <!-- Page Heading end -->

            @include('partials/messages')

            <form method="post">
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Category Code:</label>
                        <input type="text" class="form-control" name="categorycode" value="{{$customercategory->categorycode}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{$customercategory->description}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Last Running Serial Number:</label>
                        <input type="text" class="form-control" name="lastrunno" value="{{$customercategory->lastrunno}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="b_rmk">Allow Remark [Y/N]:</label>
                        <input type="text" seq="4" class="form-control enterseq" name="b_rmk" value="{{$customercategory->b_rmk}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="b_mobapp">Mobile Application [Y/N]:</label>
                        <input type="text" seq="5" class="form-control enterseq" name="b_mobapp" value="{{$customercategory->b_mobapp}}" disabled />
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\CustomerCategoriesController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a>
            </form>
        </div>
    </div>
@endsection
