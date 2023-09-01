@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Term</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form method="post">
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Term Code:</label>
                        <input type="text" class="form-control" name="term" value="{{$term->term}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{$term->description}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Term Days:</label>
                        <input type="text" class="form-control" name="termdays" value="{{$term->termdays}}" disabled/>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\TermsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>
            </div>
    </div>
@endsection
