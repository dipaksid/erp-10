@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        </div>
        @include('partials/messages')
        <form method="post" >
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}" disabled />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label for="permissions">Permissions:</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-3">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ (in_array($permission->id,$role->permissions()->pluck('id')->toArray())) ? "checked":"" }} disabled/> {{$permission->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\RolesController@index') }}" class="btn btn-secondary btn-xs">Back</a>
        </form>
        </div>
    </div>
@endsection
