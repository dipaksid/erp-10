@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Bank</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form method="post" >
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Bank Code:</label>
                        <input type="text" class="form-control" name="bankcode" value="{{$bank->code}}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$bank->name}}" disabled />
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\BanksController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>

        </div>
    </div>
@endsection
