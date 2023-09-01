@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container-fluid">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Suppliers</h1>
            </div>
            <!-- Page Heading END -->
            <div>

            @include('partials/messages')

            <form id="supplierform" method="post" action="{{ action('App\Http\Controllers\SuppliersController@update', $supplier->id) }}" >
                @csrf
                @method('PATCH')

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Supplier Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" max-length="" name="companycode" value="{{$supplier['companycode']}}"/>
                    </div>
                    <div class="col-6">
                        <label for="title">Name:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="companyname" value="{{$supplier['companyname']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{(($supplier['status'])?"checked":"") }}>
                            <label name="lblstatus" class="custom-control-label " for="status"></label>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Registration No 1:</label>
                        <input type="text" seq="3" class="form-control enterseq" name="registrationno" value="{{$supplier['registrationno']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Registration No 2:</label>
                        <input type="text" seq="4" class="form-control enterseq" name="registrationno2" value="{{$supplier['registrationno2']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Start Date:</label>
                        <input type="datetime-local" seq="5" class="form-control enterseq" placeholder="dd/mm/yyyy" name="startdate" value="{{ $supplier->startdate ? \Carbon\Carbon::createFromFormat('d/m/Y', $supplier->startdate)->format('Y-m-d\TH:i:s') : '' }}"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Homepage:</label>
                        <input type="text" seq="6" class="form-control enterseq" name="homepage" value="{{$supplier['homepage']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Term: </label>
                        <select class="form-control enterseq" seq="7" name="terms_id">
                            <option value=""> -- Selection --</option>
                            @foreach ($data["term"] as $rterm)
                                <option value="{{$rterm['id']}}" {{ (($rterm['id']==$supplier['terms_id'])?"selected":"") }}>{{$rterm['term']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h1 class="h5 mb-0 text-gray-800">Address</h1>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Address 1:</label>
                        <input type="text" seq="8" class="form-control enterseq" name="address1" value="{{$supplier['address1']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Address 2:</label>
                        <input type="text" seq="9" class="form-control enterseq" name="address2" value="{{$supplier['address2']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Address 3:</label>
                        <input type="text" seq="10" class="form-control enterseq" name="address3" value="{{$supplier['address3']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Address 4:</label>
                        <input type="text" seq="11" class="form-control enterseq" name="address4" value="{{$supplier['address4']}}"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Area:</label>
                        <select class="form-control enterseq" seq="12" name="areas_id">
                            <option value=""> -- Selection --</option>
                            @foreach ($data["area"] as $rarea)
                                <option value="{{$rarea['id']}}" {{ (($rarea['id']==$supplier['areas_id'])?"selected":"") }}>{{$rarea['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="title">Zip Code:</label>
                        <input type="text" seq="13" class="form-control enterseq" name="zipcode" value="{{$supplier['zipcode']}}"/>
                    </div>
                </div>
                <h1 class="h5 mb-0 text-gray-800">Contact</h1>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Contact Person:</label>
                        <input type="text" seq="14" class="form-control enterseq" name="contactperson" value="{{$supplier['contactperson']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Email:</label>
                        <input type="text" seq="15" class="form-control enterseq" name="email" value="{{$supplier['email']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Phone 1:</label>
                        <input type="text" seq="16" class="form-control enterseq" name="phoneno1" value="{{$supplier['phoneno1']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Phone 2:</label>
                        <input type="text" seq="17" class="form-control enterseq" name="phoneno2" value="{{$supplier['phoneno2']}}"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Fax 1:</label>
                        <input type="text" seq="18" class="form-control enterseq" name="faxno1" value="{{$supplier['faxno1']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Fax 2:</label>
                        <input type="text" seq="19" class="form-control enterseq" name="faxno2" value="{{$supplier['faxno2']}}"/>
                    </div>
                    <div class="col-3">
                        <label for="title">Email 2:</label>
                        <input type="text" seq="20" class="form-control enterseq" name="email2" value="{{$supplier['email2']}}"/>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\SuppliersController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="21" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        flatpickr("input[type=datetime-local]", { dateFormat: 'Y-m-d H:i:s' });
    </script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#supplierform").length > 0) {
            $j("#supplierform").validate({
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
                    email2: {
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
                    email2: {
                        email: "Invalid email format.",
                        maxlength: "The description should be 100 characters long."
                    },
                    homepage: {
                        url: "Invalid homepage url format.",
                        maxlength: "Homepage should be 100 characters long."
                    }
                },
            })
            $j("#supplierform").submit(function(evt){
                $j("input[type='text']").each(function(i){
                    $j(this).val($j(this).val().toUpperCase());
                })
            })
        }
        $j(document).ready(function(evt){
            $j(".enterseq").each(function(i){
                $j(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($j(this).is("input")) {
                                $j(this).val($j(this).val().toUpperCase());
                            } else if($j(this).is("button[type='submit']")) {
                                $j(this).click();
                                return false;
                            }
                            var dd = parseInt($j(this).attr("seq"),10)+1;
                            if( $j(".enterseq").filter("[seq='"+dd+"']").length>0){
                                if($j(".enterseq").filter("[seq='"+dd+"']").is("input[type='text']")) {
                                    $j("input[type='text']").filter("[seq='"+dd+"']").select();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $j("select").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("input[type='date']")){
                                    $j("input[type='date']").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $j("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($j(this).attr("seq"),10)>0)?(parseInt($j(this).attr("seq"),10)-1):parseInt($j(this).attr("seq"),10);
                            if($j("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                $j("input[type='text']").filter("[seq='"+dd+"']").select();;
                            } else if($j("input[type='date']").filter("[seq='"+dd+"']").length>0){
                                $j("input[type='date']").filter("[seq='"+dd+"']").select();;
                            } else if($j("select").filter("[seq='"+dd+"']").length>0){
                                $j("select").filter("[seq='"+dd+"']").focus();;
                            }
                            break;
                    }
                    if(keycode==13){
                        if($j(this).attr("name")=="startdate"){
                            $j(".dropdown-menu").remove();
                            if($j(this).val().length==8){

                                let date = new Date($j(this).val().substr(4,4), ($j(this).val().substr(2,2)-1), $j(this).val().substr(0,2));
                                var dd = date.getDate();
                                var mm = date.getMonth()+1;
                                var yyyy = date.getFullYear();
                                if(dd<10) {
                                    dd='0'+dd;
                                }
                                if(mm<10) {
                                    mm='0'+mm;
                                }
                                $j(this).val(dd+"/"+mm+"/"+yyyy);
                            }
                        }
                        return false;
                    }
                })
            })
            if($j(".enterseq").filter("[seq='1']").is("input")) {
                $j("input[type='text']").filter("[seq='1']").select();
            } else if($j(".enterseq").filter("[seq='1']").is("select")){
                $j("select").filter("[seq='1']").focus();
            } else if($j(".enterseq").filter("[seq='1']").is("checkbox")){
                $j("checkbox").filter("[seq='1']").select();
            } else if($j(".enterseq").filter("[seq='1']").is("button")){
                $j("button").filter("[seq='1']").focus();
            }
            $j("input[name='startdate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
                $j(this).datepicker('hide');
            });
        })
    </script>
@endsection
