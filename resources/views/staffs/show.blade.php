@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Staff</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form method="post">
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Staff Code:</label>
                        <input type="text" class="form-control" name="staffcode" value="{{$staff->staffcode}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$staff->name}}" disabled />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Company:</label>*
                        <select seq="3" class="form-control enterseq" disabled required id="comp_id" name="comp_id">
                            <option value=""></option>
                            @foreach($comp_setting as $ckey => $crow)
                                <option {{(($crow->id == $staff->comp_id)?"selected":"")}} value="{{$crow->id}}"> {{$crow->companyname}} ({{$crow->companycode}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Designation:</label>
                        <input type="text" seq="3" class="form-control enterseq" name="designation" disabled value="{{$staff->designation}}" maxlength="20"/>
                        <span class="text-danger">{{ $errors->first('designation') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Department:</label>
                        <input type="text" seq="4" class="form-control enterseq" name="department" disabled value="{{$staff->department}}" maxlength="20"/>
                        <span class="text-danger">{{ $errors->first('department') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Date Joined:</label>
                        <input type="text" seq="5" class="form-control enterseq" name="date_join" disabled value="{{$staff->date_join}}" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('date_join') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Last Review:</label>
                        <input type="text" seq="11" readonly class="form-control enterseq" name="last_review" value="{{$staff->last_review}}" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('last_review') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Commission Rate:</label>
                        <input type="text" class="form-control" name="commrate" value="{{$staff->commrate}}" disabled />
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\StaffsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            </form>
        </div>
    </div>
@endsection
