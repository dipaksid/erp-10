@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Permissions</h1>
            </div>
            @include('partials/messages')
            <form method="post" >
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$permission->name}}" disabled />
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\PermissionsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>
        </div>
    </div>
@endsection
