@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Company Settings</h1>
        </div>
        @include('partials/messages')
        <form method="post">
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Company Code:</label>
                    <input type="text" seq="1" class="form-control enterseq" maxlength="20" name="companycode" value="{{$companySetting->companycode}}" disabled />
                    <span class="text-danger">{{ $errors->first('companycode') }}</span>
                </div>
                <div class="col-9">
                    <label for="title">Company Name:</label>
                    <input type="text" seq="2" class="form-control enterseq" name="companyname" value="{{$companySetting->companyname}}" disabled />
                    <span class="text-danger">{{ $errors->first('companyname') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Registration No 1:</label>
                    <input type="text" seq="3" class="form-control enterseq" name="registrationno" value="{{$companySetting->registrationno}}" disabled />
                    <span class="text-danger">{{ $errors->first('registrationno') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Registration No 2:</label>
                    <input type="text" seq="4" class="form-control enterseq" name="registrationno2" value="{{$companySetting->registrationno2}}" disabled />
                    <span class="text-danger">{{ $errors->first('registrationno2') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">GST No:</label>
                    <input type="text" seq="5" class="form-control enterseq" name="gstno" value="{{$companySetting->gstno}}" disabled />
                    <span class="text-danger">{{ $errors->first('gstno') }}</span>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Bank Info</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Bank 1:</label>
                    <select class="form-control enterseq" seq="6" name="bankid1" disabled >
                        <option value=""> -- Selection --</option>
                        @foreach ($data["bank"] as $rbank)
                            <option value="{{$rbank['id']}}" {!!(($rbank['id']==$companySetting->bankid1)?"selected":"")!!}>{{$rbank['bankcode']." - ".$rbank['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bank Account 1:</label>
                    <input type="text" seq="7" class="form-control enterseq" name="bankacc1" value="{{$companySetting->bankacc1}}" disabled />
                    <span class="text-danger">{{ $errors->first('bankacc1') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Bank 2:</label>
                    <select class="form-control enterseq" seq="8" name="bankid2" disabled >
                        <option value=""> -- Selection --</option>
                        @foreach ($data["bank"] as $rbank)
                            <option value="{{$rbank['id']}}" {!!(($rbank['id']==$companySetting->bankid2)?"selected":"")!!}>{{$rbank['bankcode']."-".$rbank['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bank Account 2:</label>
                    <input type="text" seq="9" class="form-control enterseq" name="bankacc2" value="{{$companySetting->bankacc2}}" disabled />
                    <span class="text-danger">{{ $errors->first('bankacc2') }}</span>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Address</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Address 1:</label>
                    <input type="text" seq="10" class="form-control enterseq" name="address1" value="{{$companySetting->address1}}" disabled />
                    <span class="text-danger">{{ $errors->first('address1') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Address 2:</label>
                    <input type="text" seq="11" class="form-control enterseq" name="address2" value="{{$companySetting->address2}}" disabled />
                    <span class="text-danger">{{ $errors->first('address2') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Address 3:</label>
                    <input type="text" seq="12" class="form-control enterseq" name="address3" value="{{$companySetting->address3}}" disabled />
                    <span class="text-danger">{{ $errors->first('address3') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Address 4:</label>
                    <input type="text" seq="13" class="form-control enterseq" name="address4" value="{{$companySetting->address4}}" disabled />
                    <span class="text-danger">{{ $errors->first('address4') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Area:</label>
                    <select class="form-control enterseq" seq="14" name="areaid" disabled >
                        <option value=""> -- Selection --</option>
                        @foreach ($data["area"] as $rarea)
                            <option value="{{$rarea['id']}}" {!!(($rarea['id']==$companySetting->areaid)?"selected":"")!!}>{{$rarea['description']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bandar:</label>
                    <input type="text" seq="15" class="form-control enterseq" name="city" value="{{$companySetting->city}}" disabled />
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Zip Code:</label>
                    <input type="text" seq="16" class="form-control enterseq" name="zipcode" value="{{$companySetting->zipcode}}" disabled />
                    <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Contact</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Contact Person 1:</label>
                    <input type="text" seq="17" class="form-control enterseq" name="contactperson" value="{{$companySetting->contactperson}}" disabled />
                    <span class="text-danger">{{ $errors->first('contactperson') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Contact Person 2:</label>
                    <input type="text" seq="18" class="form-control enterseq" name="contactperson2" value="{{$companySetting->contactperson2}}" disabled />
                    <span class="text-danger">{{ $errors->first('contactperson2') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Phone 1:</label>
                    <input type="text" seq="19" class="form-control enterseq" name="phoneno1" value="{{$companySetting->phoneno1}}" disabled />
                    <span class="text-danger">{{ $errors->first('phoneno1') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Phone 2:</label>
                    <input type="text" seq="20" class="form-control enterseq" name="phoneno2" value="{{$companySetting->phoneno2}}" disabled />
                    <span class="text-danger">{{ $errors->first('phoneno2') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Email 1:</label>
                    <input type="text" seq="21" class="form-control enterseq" name="email" value="{{$companySetting->email}}" disabled />
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Email 2:</label>
                    <input type="text" seq="22" class="form-control enterseq" name="email2" value="{{$companySetting->email2}}" disabled />
                    <span class="text-danger">{{ $errors->first('email2') }}</span>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Letter Head / Foot</h1>
            <div class="row form-group">
                <div class="col-3 mh-25 mg-25">
                    <label for="title">Letter Head</label>
                    @if(file_exists(public_path()."/company/".$companySetting->id."/bwheader.jpg"))
                        <img src="{{url('/').'/company/'.$companySetting->id.'/bwheader.jpg'}}" style="width:200px;" class="img-fluid w-25">
                    @endif
                </div>
                <div class="col-3 w-100 h-100">
                    <label for="title">Letter Foot</label>
                    @if(file_exists(public_path()."/company/".$companySetting->id."/bwfooter.jpg"))
                        <img src="{{url('/')."/company/".$companySetting->id."/bwfooter.jpg"}}" style="width:200px;" class="img-fluid w-25">
                    @endif
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\CompanySettingsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
        </form>
        </div>
    </div>
@endsection
