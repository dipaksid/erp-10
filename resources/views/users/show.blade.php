@extends('layouts.app')

@section('content')
    <div class="container-fluid ps-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Users
            </h1>
        </div>

        @include('partials.messages')

        <form method="post" >
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" disabled />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="rolesid">Roles:</label>
                    <select class="form-control" name="rolesid" disabled>
                        <option value=""> -- Selection --</option>
                        @foreach ($data["roles"] as $rroles)
                            <option value="{{ $rroles['id']}}" {{ (($rroles['id']==$user->roles()->pluck('id')->implode(' '))?'selected':'') }}>{{$rroles['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('rolesid') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="rolesid">Staff ID:</label>
                    <select class="form-control enterseq" seq="4" disabled name="staff_id">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["staff"] as $rstaff)
                            <option value="{{ $rstaff['id'] }}" {{ (($rstaff['id']==$user->staff_id)?'selected':'') }}>{{ $rstaff['name'] }} ({{ $rstaff['staffcode'] }})</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('rolesid') }}</span>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\UsersController@index') }}" class="btn btn-secondary btn-xs">Back</a>
        </form>

    </div>
@endsection
