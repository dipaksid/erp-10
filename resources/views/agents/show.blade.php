@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Agents</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form method="post" >
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Agent Code:</label>
                        <input type="text" class="form-control" name="agentcode" value="{{$agent->agentcode}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$agent->name}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Area:</label>
                        <select class="form-control" name="areas_id" disabled>
                            <option value=""> -- Selection --</option>
                            @foreach ($data["area"] as $id => $rarea)
                                <option value="{{ $id }}" {{ (($id == $agent['areas_id']) ? "selected" : "") }}>
                                    {{ $rarea }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Commission Rate:</label>
                        <input type="text" class="form-control" name="commrate" value="{{$agent->commrate}}" disabled />
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\AgentsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>
        </div>
    </div>
@endsection
