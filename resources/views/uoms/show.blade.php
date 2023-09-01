@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">UOMs</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form method="post" >
                <div class="row form-group">
                    <div class="col-3">
                        <label for="uomcode">Stock Code:</label>
                        <input type="text" class="form-control" name="name" value="{{$uom->uomsstock()->pluck('stockcode')->implode('')}}" disabled />
                        <span class="text-danger">{{ $errors->first('uomcode') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">UOMs Code:</label>
                        <input type="text" class="form-control" name="name" value="{{$uom->uomcode}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{$uom->description}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isactive" name="isactive" {{(($uom->isactive=='1')?"checked":"")}} disabled >
                            <label class="custom-control-label" for="isactive"></label>
                        </div>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\UomsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>
        </div>
    </div>
@endsection
