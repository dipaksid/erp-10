@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customers</h1>
        </div>
        <!-- Page Heading end -->
        @include('partials/messages')
        <form id="customerform" method="post" action="{{ url('customers') }}">
            @csrf
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Customer Code:</label>
                    <input type="text" seq="1" class="form-control enterseq" name="companycode" placeholder="AUTO-GENERATE" value="{{ old('companycode') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Name:</label>
                    <input type="text" seq="2" class="form-control enterseq" name="companyname" value="{{ old('companyname') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Short Name:</label>
                    <input type="text" seq="3" class="form-control enterseq" name="shortname" value="{{ old('shortname') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Active:</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" checked value="{{ old('status') }}">
                        <label name="lblstatus" class="custom-control-label " for="status"></label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Registration No 1:</label>
                    <input type="text" seq="4" class="form-control enterseq" name="registrationno" value="{{ old('registrationno') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Registration No 2:</label>
                    <input type="text" seq="5" class="form-control enterseq" name="registrationno2" value="{{ old('registrationno2') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Customer Category:</label>
                    <select class="form-control enterseq" seq="6" name="categoryid">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["category"] as $rcatg)
                            <option value="{{$rcatg['id']}}" @if(old('categoryid') == $rcatg['id']) selected @endif>
                                {{$rcatg['description']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Start Date:</label>
                    <input type="text" seq="7" class="form-control enterseq" placeholder="dd/mm/yyyy" name="startdate" value="{{ (isset($default['logindate']))?$default['logindate']:old('logindate') }}"/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Homepage:</label>
                    <input type="text" seq="8" class="form-control enterseq" name="homepage" value="{{(isset($data['homepage']))?$data['homepage']:old('homepage') }}"/>
                </div>
                <div class="col-3">
                    <label for="title">Customer Group:</label>
                    <select class="form-control enterseq" seq="9" name="customergroupid">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["customer_group"] as $rcustomergroup)
                            <option value="{{$rcustomergroup['id']}}" @if(old('customergroupid') == $rcustomergroup['id']) selected @endif>
                                {{$rcustomergroup['groupcode'].'-'.$rcustomergroup['description']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Folder Name:</label>
                    <input type="text" seq="10" class="form-control enterseq" name="foldername" value="{{ old('foldername') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Term:</label>
                    <select class="form-control enterseq" seq="11" name="termid">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["term"] as $rterm)
                            <option value="{{$rterm['id']}}" @if(old('termid') == $rterm['id']) selected @endif>
                                {{$rterm['term']}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Address</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Address 1:</label>
                    <input type="text" seq="12" class="form-control enterseq" name="address1" value="{{ old('address1') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Address 2:</label>
                    <input type="text" seq="13" class="form-control enterseq" name="address2" value="{{ old('address2') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Address 3:</label>
                    <input type="text" seq="14" class="form-control enterseq" name="address3" value="{{ old('address3') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Address 4:</label>
                    <input type="text" seq="15" class="form-control enterseq" name="address4" value="{{ old('address4') }}" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Area:</label>
                    <select class="form-control enterseq" seq="16" name="areaid">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["area"] as $rarea)
                            <option value="{{$rarea['id']}}" @if(old('areaid') == $rarea['id']) selected @endif>
                                {{$rarea['description']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="title">Bandar:</label>
                    <input type="text" seq="17" class="form-control enterseq" name="bandar" value="{{ old('bandar') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Zip Code:</label>
                    <input type="text" seq="18" class="form-control enterseq" name="zipcode" value="{{ old('zipcode') }}" />
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">Contact</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Contact Person:</label>
                    <input type="text" seq="19" class="form-control enterseq" name="contactperson" value="{{ old('contactperson') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Phone 1:</label>
                    <input type="text" seq="20" class="form-control enterseq" name="phoneno1" value="{{ old('phoneno1') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Phone 2:</label>
                    <input type="text" seq="21" class="form-control enterseq" name="phoneno2" value="{{ old('phoneno2') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Fax 1:</label>
                    <input type="text" seq="22" class="form-control enterseq" name="faxno1" value="{{ old('faxno1') }}" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Fax 2:</label>
                    <input type="text" seq="23" class="form-control enterseq" name="faxno2" value="{{ old('faxno2') }}"/>
                </div>
                <div class="col-3">
                    <label for="title">Email 1:</label>
                    <input type="text" seq="24" class="form-control enterseq" name="email" value="{{ old('email') }}" />
                </div>
                <div class="col-3">
                    <label for="title">Email 2:</label>
                    <input type="text" seq="25" class="form-control enterseq" name="email2" value="{{ old('email2') }}"/>
                </div>
                <div class="col-3">
                    <label for="title">Email 3:</label>
                    <input type="text" seq="26" class="form-control enterseq" name="email3" value="{{ old('email3') }}"/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="remarks">Remarks:</label>
                    <input type="text" seq="27" class="form-control enterseq" name="remarks" value="{{ old('remarks') }}" />
                </div>
                <div class="col-6">
                    <label for="serviceremarks">Service Remarks:</label>
                    <input type="text" seq="28" class="form-control enterseq" name="serviceremarks" value="{{ old('serviceremarks') }}" />
                </div>
            </div>
            <h1 class="h5 mb-0 text-gray-800">AI Services</h1>
            <div class="row form-group">
                <div class="col-3">
                    <label for="b_aiservice">AI Services:</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="b_aiservice" name="b_aiservice" checked>
                        <label name="lblb_aiservice" class="custom-control-label" for="b_aiservice"></label>
                    </div>
                </div>
            </div>
            <a href="{{ action('\App\Http\Controllers\CustomersController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            <button type="submit" seq="29" class="btn btn-primary enterseq">Create</button>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        if ($("#customerform").length > 0) {
            $("#customerform").validate({
                rules: {
                    companyname: {
                        required: true,
                        maxlength: 100
                    },
                    areaid: {
                        required: true
                    },
                    email: {
                        email: true,
                        maxlength:100
                    },
                    homepage: {
                        url: true,
                        maxlength:100
                    }
                },
                messages: {
                    companyname: {
                        required: "Please enter name.",
                        maxlength: "Name maxlength should be 100 characters long."
                    },
                    areaid: {
                        required: "Please enter area."
                    },
                    email: {
                        email: "Invalid email format.",
                        maxlength: "The description should be 100 characters long."
                    },
                    homepage: {
                        url: "Invalid homepage url format.",
                        maxlength: "Homepage should be 100 characters long."
                    }
                },
            })
            $("#customerform").submit(function(evt){
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
                                if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='text']")) {
                                    $("input[type='text']").filter("[seq='"+dd+"']").select();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $("select").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='date']")){
                                    $("input[type='date']").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($(this).attr("seq"),10)>0)?(parseInt($(this).attr("seq"),10)-1):parseInt($(this).attr("seq"),10);
                            if($("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                $("input[type='text']").filter("[seq='"+dd+"']").select();;
                            } else if($("input[type='date']").filter("[seq='"+dd+"']").length>0){
                                $("input[type='date']").filter("[seq='"+dd+"']").select();;
                            } else if($("select").filter("[seq='"+dd+"']").length>0){
                                $("select").filter("[seq='"+dd+"']").focus();;
                            }
                            break;
                    }
                    if(keycode==13){
                        if($(this).attr("name")=="startdate"){
                            $(".dropdown-menu").remove();
                            if($(this).val().length==8){

                                let date = new Date($(this).val().substr(4,4), ($(this).val().substr(2,2)-1), $(this).val().substr(0,2));
                                var dd = date.getDate();
                                var mm = date.getMonth()+1;
                                var yyyy = date.getFullYear();
                                if(dd<10) {
                                    dd='0'+dd;
                                }
                                if(mm<10) {
                                    mm='0'+mm;
                                }
                                $(this).val(dd+"/"+mm+"/"+yyyy);
                            }
                        }
                        return false;
                    }
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
            $("input[name='startdate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
                $(this).datepicker('hide');
            });
        })
    </script>
@endsection
