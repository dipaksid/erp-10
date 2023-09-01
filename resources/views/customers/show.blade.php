@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer</h1>
        </div>
        @include('partials/messages')
        <form method="post" >
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Customer Code:</label>
                    <input type="text" seq="1" class="form-control enterseq" max-length="" name="companycode" value="{{ $customer['companycode'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Name:</label>
                    <input type="text" seq="2" class="form-control enterseq" name="companyname" value="{{ $customer['companyname'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Short Name:</label>
                    <input type="text" seq="3" class="form-control enterseq" name="shortname" value="{{ $customer['shortname'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Active:</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" {{ (($customer['status']=="1")?"checked":"") }} disabled>
                        <label name="lblstatus" class="custom-control-label " for="status"></label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Registration No 1:</label>
                    <input type="text" seq="4" class="form-control enterseq" name="registrationno" value="{{ $customer['registrationno'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Registration No 2:</label>
                    <input type="text" seq="5" class="form-control enterseq" name="registrationno2" value="{{ $customer['registrationno2'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Customer Category:</label>
                    <select class="form-control enterseq" seq="6" name="categoryid" disabled>
                        <option value=""> -- Selection --</option>
                        @foreach ($data["category"] as $rcatg)
                            <option value="{{ $rcatg['id'] }}" {{ (($rcatg['id']==$customer['categoryid'])?"selected":"") }}>{{ $rcatg['description'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Start Date:</label>
                    <input type="text" seq="7" class="form-control enterseq" placeholder="dd/mm/yyyy" name="startdate" value="{{ $customer['startdate'] }}" disabled/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Homepage:</label>
                    <input type="text" seq="8" class="form-control enterseq" name="homepage" value="{{ $customer['homepage'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Customer Group:</label>
                    <select class="form-control enterseq" seq="9" name="customergroupid" disabled/>
                    <option value=""> -- Selection --</option>
                    @foreach ($data["customer_group"] as $rcustomergroup)
                        <option value="{{ $rcustomergroup['id'] }}" {{ (($rcustomergroup['id']==((!empty($data["group_detail"][0]))?$data["group_detail"][0]["customergroupid"]:"") )?"selected":"") }}>{{ $rcustomergroup['groupcode'].'-'.$rcustomergroup['description'] }}</option>
                        @endforeach
                        </select>
                </div>
                <div class="col-3">
                    <label for="title">Folder Name:</label>
                    <input type="text" seq="9" class="form-control enterseq" name="foldername" value="{{ $customer['foldername'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Term:</label>
                    <select class="form-control enterseq" seq="10" name="termid" disabled>
                        <option value=""> -- Selection --</option>
                        @foreach ($data["term"] as $rterm)
                            <option value="{{ $rterm['id']}}" {{ (($rterm['id']==$customer['termid'])?"selected":"") }}>{{ $rterm['term'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Address</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Address 1:</label>
                    <input type="text" seq="11" class="form-control enterseq" name="address1" value="{{ $customer['address1'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Address 2:</label>
                    <input type="text" seq="12" class="form-control enterseq" name="address2" value="{{ $customer['address2'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Address 3:</label>
                    <input type="text" seq="13" class="form-control enterseq" name="address3" value="{{ $customer['address3'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Address 4:</label>
                    <input type="text" seq="14" class="form-control enterseq" name="address4" value="{{ $customer['address4'] }}" disabled/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Area:</label>
                    <select class="form-control enterseq" seq="15" name="areaid" disabled>
                        <option value=""> -- Selection --</option>
                        @foreach ($data["area"] as $rarea)
                            <option value="{{ $rarea['id'] }}" {{ (($rarea['id']==$customer['areaid'])?"selected":"") }}>
                                {{ $rarea['description'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bandar:</label>
                    <input type="text" seq="16" class="form-control enterseq" name="bandar" value="{{ $customer['bandar'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Zip Code:</label>
                    <input type="text" seq="17" class="form-control enterseq" name="zipcode" value="{{ $customer['zipcode'] }}" disabled/>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Contact</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Contact Person:</label>
                    <input type="text" seq="18" class="form-control enterseq" name="contactperson" value="{{ $customer['contactperson'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Phone 1:</label>
                    <input type="text" seq="19" class="form-control enterseq" name="phoneno1" value="{{ $customer['phoneno1'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Phone 2:</label>
                    <input type="text" seq="20" class="form-control enterseq" name="phoneno2" value="{{ $customer['phoneno2'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Fax 1:</label>
                    <input type="text" seq="21" class="form-control enterseq" name="faxno1" value="{{ $customer['faxno1'] }}" disabled/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Fax 2:</label>
                    <input type="text" seq="22" class="form-control enterseq" name="faxno2" value="{{ $customer['faxno2'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Email:</label>
                    <input type="text" seq="23" class="form-control enterseq" name="email" value="{{ $customer['email'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Email:</label>
                    <input type="text" seq="24" class="form-control enterseq" name="email2" value="{{ $customer['email2'] }}" disabled/>
                </div>
                <div class="col-3">
                    <label for="title">Email:</label>
                    <input type="text" seq="25" class="form-control enterseq" name="email3" value="{{ $customer['email3'] }}" disabled/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="remarks">Remarks:</label>
                    <input type="text" seq="26" class="form-control enterseq" name="remarks" value="{{ $customer['remarks'] }}" disabled/>
                </div>
                <div class="col-6">
                    <label for="serviceremarks">Service Remarks:</label>
                    <input type="text" seq="27" class="form-control enterseq" name="serviceremarks" value="{{ $customer['serviceremarks'] }}" disabled/>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">AI Services</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="b_aiservice">AI Services:</label>
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_aiservice" name="b_aiservice" {{ (($customer['b_aiservice']=="Y")?"checked":"") }} disabled>
                            <label name="lblb_aiservice" class="custom-control-label " for="b_aiservice"></label>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\CustomersController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a>
        </form>
        </div>
    </div>
@endsection
