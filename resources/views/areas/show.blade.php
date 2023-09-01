@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start-->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Area</h1>
            </div>
            <!-- Page Heading End-->

            @include('partials/messages')

            <form method="post">

                <input name="_method" type="hidden" value="PATCH">
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Area Code:</label>
                        <input type="text" class="form-control" name="areacode" value={{$area->areacode}} disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Description:</label>
                        <input type="text" class="form-control" name="description" value={{$area->description}} disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isactive" name="isactive" {{(($area->isactive=='1')?"checked":"")}} disabled >
                            <label class="custom-control-label" for="isactive"></label>
                        </div>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\AreasController@index') }}" class="btn btn-secondary btn-xs">Back</a>

            </form>
        </div>
    </div>
@endsection
