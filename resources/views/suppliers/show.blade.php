@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Suppliers</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form method="post">
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Supplier Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" max-length="" name="companycode" value="{{$supplier['companycode']}}" disabled/>
                    </div>
                    <div class="col-6">
                        <label for="title">Name:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="companyname" value="{{$supplier['companyname']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                            <label name="lblstatus" class="custom-control-label " for="status"></label>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Registration No 1:</label>
                        <input type="text" seq="3" class="form-control enterseq" name="registrationno" value="{{$supplier['registrationno']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Registration No 2:</label>
                        <input type="text" seq="4" class="form-control enterseq" name="registrationno2" value="{{$supplier['registrationno2']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Start Date:</label>
                        <input type="text" seq="6" class="form-control enterseq" placeholder="dd/mm/yyyy" name="startdate" value="{{$supplier['startdate']}}" disabled/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Homepage:</label>
                        <input type="text" seq="7" class="form-control enterseq" name="homepage" value="{{$supplier['homepage']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Term:</label>
                        <select class="form-control enterseq" seq="8" name="termid" disabled>
                            <option value=""> -- Selection --</option>
                            @foreach ($data["term"] as $rterm)
                                <option value="{{$rterm['id']}}" {{ (($rterm['id']==$supplier['termid'])?"selected":"") }}>{{$rterm['term']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h1 class="h5 mb-0 text-gray-800">Address</h1>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Address 1:</label>
                        <input type="text" seq="9" class="form-control enterseq" name="address1" value="{{$supplier['address1']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Address 2:</label>
                        <input type="text" seq="10" class="form-control enterseq" name="address2" value="{{$supplier['address2']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Address 3:</label>
                        <input type="text" seq="11" class="form-control enterseq" name="address3" value="{{$supplier['address3']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Address 4:</label>
                        <input type="text" seq="12" class="form-control enterseq" name="address4" value="{{$supplier['address4']}}" disabled/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Area:</label>
                        <select class="form-control enterseq" seq="13" name="areaid" disabled>
                            <option value=""> -- Selection --</option>
                            @foreach ($data["area"] as $rarea)
                                <option value="{{$rarea['id']}}" {{ (($rarea['id']==$supplier['areaid'])?"selected":"") }}>{{$rarea['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="title">Zip Code:</label>
                        <input type="text" seq="14" class="form-control enterseq" name="zipcode" value="{{$supplier['zipcode']}}" disabled/>
                    </div>
                </div>
                <h1 class="h5 mb-0 text-gray-800">Contact</h1>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Contact Person:</label>
                        <input type="text" seq="15" class="form-control enterseq" name="contactperson" value="{{$supplier['contactperson']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Email:</label>
                        <input type="text" seq="16" class="form-control enterseq" name="email" value="{{$supplier['email']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Phone 1:</label>
                        <input type="text" seq="17" class="form-control enterseq" name="phoneno1" value="{{$supplier['phoneno1']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Phone 2:</label>
                        <input type="text" seq="18" class="form-control enterseq" name="phoneno2" value="{{$supplier['phoneno2']}}" disabled/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Fax 1:</label>
                        <input type="text" seq="19" class="form-control enterseq" name="faxno1" value="{{$supplier['faxno1']}}" disabled/>
                    </div>
                    <div class="col-3">
                        <label for="title">Fax 2:</label>
                        <input type="text" seq="20" class="form-control enterseq" name="faxno2" value="{{$supplier['faxno2']}}" disabled/>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\SuppliersController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a>
            </form>
        </div>
    </div>
@endsection
