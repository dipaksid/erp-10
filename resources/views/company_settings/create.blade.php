@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Company Settings</h1>
        </div>
        <!-- Page Heading End -->
        @include('partials/messages')

        <form id="companyform" method="post" action="{{ url('company_settings') }}" enctype="multipart/form-data">
            @csrf
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Company Code:</label>
                    <input type="text" seq="1" class="form-control enterseq" maxlength="20" name="companycode" value="{{ old('companycode') }}" />
                </div>
                <div class="col-9">
                    <label for="title">Company Name:</label>
                    <input type="text" seq="2" class="form-control enterseq" name="companyname" value="{{ old('companyname') }}" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Registration No 1:</label>
                    <input type="text" seq="3" class="form-control enterseq" name="registrationno" value="{{ old('registrationno') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Registration No 2:</label>
                    <input type="text" seq="4" class="form-control enterseq" name="registrationno2" value="{{ old('registrationno2') }}" />
                </div>
                <div class="col-3">
                    <label for="title">GST No:</label>
                    <input type="text" seq="5" class="form-control enterseq" name="gstno" value="{{ old('gstno') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Default:</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="b_default" name="b_default" value="{{ old('b_default') }}">
                        <label name="lblb_default" class="custom-control-label " for="b_default"></label>
                    </div>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Bank Info</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Bank 1:</label>
                    <select class="form-control enterseq" seq="6" name="bankid1">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["bank"] as $rbank)
                            <option value="{{ $rbank['id'] }}"  @if(old('bankid1') == $rbank['id']) selected @endif>
                                {{ $rbank['bankcode']." - ".$rbank['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bank Account 1:</label>
                    <input type="text" seq="7" class="form-control enterseq" name="bankacc1" value="{{ old('bankacc1') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Bank 2:</label>
                    <select class="form-control enterseq" seq="8" name="bankid2">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["bank"] as $rbank)
                            <option value="{{ $rbank['id'] }}"  @if(old('id') == $rbank['id']) selected @endif>
                                {{ $rbank['bankcode']."-".$rbank['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bank Account 2:</label>
                    <input type="text" seq="9" class="form-control enterseq" name="bankacc2" value="{{ old('bankacc2') }}" />
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Address</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Address 1:</label>
                    <input type="text" seq="10" class="form-control enterseq" name="address1" value="{{ old('address1') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Address 2:</label>
                    <input type="text" seq="11" class="form-control enterseq" name="address2" value="{{ old('address2') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Address 3:</label>
                    <input type="text" seq="12" class="form-control enterseq" name="address3" value="{{ old('address3') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Address 4:</label>
                    <input type="text" seq="13" class="form-control enterseq" name="address4" value="{{ old('address4') }}" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Area:</label>
                    <select class="form-control enterseq" seq="14" name="areaid">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["area"] as $rarea)
                            <option value="{{ $rarea['id'] }}" @if(old('id') == $rbank['id']) selected @endif>
                                {{ $rarea['description'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bandar:</label>
                    <input type="text" seq="15" class="form-control enterseq" name="city" value="{{ old('city') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Zip Code:</label>
                    <input type="text" seq="16" class="form-control enterseq" name="zipcode" value="{{ old('zipcode') }}" />
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Contact</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Contact Person 1:</label>
                    <input type="text" seq="17" class="form-control enterseq" name="contactperson" value="{{ old('contactperson') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Contact Person 2:</label>
                    <input type="text" seq="18" class="form-control enterseq" name="contactperson2" value="{{ old('contactperson2') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Phone 1:</label>
                    <input type="text" seq="19" class="form-control enterseq" name="phoneno1" value="{{ old('phoneno1') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Phone 2:</label>
                    <input type="text" seq="20" class="form-control enterseq" name="phoneno2" value="{{ old('phoneno2') }}" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Email 1:</label>
                    <input type="text" seq="21" class="form-control enterseq" name="email" value="{{ old('email') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Email 2:</label>
                    <input type="text" seq="22" class="form-control enterseq" name="email2" value="{{ old('email2') }}" />
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Letter Head / Foot</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Letter Head</label>
                    <input type="file" class="form-control" name="companyltrheader"/>
                    <span class="text-danger">{{ $errors->first('companyltrheader') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Letter Foot:</label>
                    <input type="file" class="form-control" name="companyltrfooter"/>
                    <span class="text-danger">{{ $errors->first('companyltrfooter') }}</span>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\CompanySettingsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            <button type="submit" seq="23" class="btn btn-primary enterseq">Create</button>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        if ($("#companyform").length > 0) {
            $("#companyform").validate({
                rules: {
                    companycode: {
                        required: true,
                        maxlength: 20
                    },
                    companyname: {
                        required: true,
                        maxlength:200
                    },
                    registrationno: {
                        maxlength:50
                    },
                    registrationno2: {
                        maxlength:50
                    },
                    gstno: {
                        maxlength:30
                    },
                    bankacc1: {
                        maxlength:20
                    },
                    bankacc2: {
                        maxlength:20
                    },
                    address1: {
                        maxlength:40
                    },
                    address2: {
                        maxlength:40
                    },
                    address3: {
                        maxlength:40
                    },
                    address4: {
                        maxlength:40
                    },
                    city: {
                        maxlength:50
                    },
                    zipcode : {
                        maxlength:5
                    },
                    contactperson: {
                        maxlength:50
                    },
                    contactperson2: {
                        maxlength:50
                    },
                    phoneno1: {
                        maxlength:20
                    },
                    phoneno2: {
                        maxlength:20
                    },
                    email : {
                        maxlength:50
                    },
                    email2: {
                        maxlength:50
                    }
                },
                messages: {
                    companycode: {
                        required: "Please enter Company Code",
                        maxlength: "Your Company Code maxlength should be 20 characters long."
                    },
                    companyname: {
                        required: "Please enter Company Name",
                        maxlength: "The Company Name should be 200 characters long"
                    },
                    registrationno: {
                        maxlength: "Registration No should be 50 digits characters long."
                    },
                    registrationno2: {
                        maxlength: "Registration No 2 should be 50 digits characters long."
                    },
                    gstno: {
                        maxlength: "GST No should be 30 digits characters long."
                    },
                    bankacc1: {
                        maxlength: "Bank Account 1 should be 20 digits characters long."
                    },
                    bankacc2: {
                        maxlength: "Bank Account 2 should be 20 digits characters long."
                    },
                    address1: {
                        maxlength: "Address 1 should be 40 digits characters long."
                    },
                    address2: {
                        maxlength: "Address 2 should be 40 digits characters long."
                    },
                    address3: {
                        maxlength: "Address 3 should be 40 digits characters long."
                    },
                    address4: {
                        maxlength: "Address 4 should be 40 digits characters long."
                    },
                    city: {
                        maxlength: "City should be 50 digits characters long."
                    },
                    zipcode : {
                        maxlength: "Zip Code should be 50 digits characters long."
                    },
                    contactperson: {
                        maxlength: "Contact Person should be 50 digits characters long."
                    },
                    contactperson2: {
                        maxlength: "Contact Person 2 should be 50 digits characters long."
                    },
                    phoneno1: {
                        maxlength: "Phone 1 should be 20 digits characters long."
                    },
                    phoneno2: {
                        maxlength: "Phone 2 should be 20 digits characters long."
                    },
                    email : {
                        maxlength: "Email should be 80 digits characters long."
                    },
                    email2: {
                        maxlength: "Email 2 should be 80 digits characters long."
                    }
                },
            })
            $("#companyform").submit(function(evt){
                $("input[type='text']").each(function(i){
                    $(this).val($(this).val().toUpperCase());
                })
            })
        }
        $(document).ready(function(evt){
            $(".enterseq").each(function(i){
                $(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($(this).is("input")) {
                                $(this).val($(this).val().toUpperCase());
                            } else if($(this).is("button[type='submit']")) {
                                $(this).click();
                                return false;
                            }
                            var dd = parseInt($(this).attr("seq"),10)+1;
                            if( $(".enterseq").filter("[seq='"+dd+"']").length>0){
                                if($(".enterseq").filter("[seq='"+dd+"']").is("input")) {
                                    $("input[type='text']").filter("[seq='"+dd+"']").select();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $("select").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("checkbox")){
                                    $("checkbox").filter("[seq='"+dd+"']").select();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($(this).attr("seq"),10)>0)?(parseInt($(this).attr("seq"),10)-1):parseInt($(this).attr("seq"),10);
                            if($("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                $("input[type='text']").filter("[seq='"+dd+"']").select();;
                            } else if($("select").filter("[seq='"+dd+"']").length>0){
                                $("select").filter("[seq='"+dd+"']").focus();;
                            }
                    }
                    if(keycode==13)
                        return false;
                })
            })
            if($(".enterseq").filter("[seq='1']").is("input")) {
                $("input[type='text']").filter("[seq='1']").select();
            } else if($(".enterseq").filter("[seq='1']").is("select")){
                $("select").filter("[seq='1']").focus();
            } else if($(".enterseq").filter("[seq='1']").is("checkbox")){
                $("checkbox").filter("[seq='1']").select();
            } else if($(".enterseq").filter("[seq='1']").is("button")){
                $("button").filter("[seq='1']").focus();
            }
        })
    </script>
@endsection
