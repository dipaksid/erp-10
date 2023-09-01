@extends('layouts.app')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="container-fluid">

        <div class="container">

            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Totalpay App Services</h1>
            </div>
            <!-- Page Heading END -->

            @include('partials/messages')

            <form id="totalpayappform" method="post" action="{{ action('App\Http\Controllers\TotalpayAppsController@update', $totalpayapp->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input name="id" type="hidden" value="{{ $totalpayapp->id }}">
                <input type="hidden" name="serviceid" id="serviceid">

                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="title">Customers:</label>
                        <select class="form-control customerAutoSelect enterseq overflow-ellipsis" seq="1" name="customers_id"
                                placeholder="Customer search"
                                autocomplete="off">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer['id'] }}" {{ $totalpayapp->customers_id == $customer['id'] ? 'selected' : '' }}>
                                    {{ $customer['text'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="comp_logo">Company APP Logo: (.jpg,.gif,.png,.tiff) (512px x512px)</label>
                        <input type="file" class="form-control" accept="image/jpeg image/png image/gif image/tiff" id="comp_logo" name="comp_logo"/>

                        <span class="text-danger">{{ $errors->first('comp_logo') }}</span>
                        @if(file_exists(public_path("totalpay/".$totalpayapp->customer_services_id.'/comp_logo.jpg')))
                            <img src="{{ asset('totalpay/'.$totalpayapp->customer_services_id.'/comp_logo.jpg') }}" width="200" height="200">
                        @elseif(file_exists(public_path("totalpay/".$totalpayapp->customer_services_id.'/comp_logo.png')))
                            <img src="{{ asset('totalpay/'.$totalpayapp->customer_services_id.'/comp_logo.png') }}" width="200" height="200">
                        @elseif(file_exists(public_path("totalpay/".$totalpayapp->customer_services_id.'/comp_logo.gif')))
                            <img src="{{ asset('totalpay/'.$totalpayapp->customer_services_id.'/comp_logo.gif') }}" width="200" height="200">
                        @elseif(file_exists(public_path("totalpay/".$totalpayapp->customer_services_id.'/comp_logo.tiff')))
                            <img src="{{ asset('totalpay/'.$totalpayapp->customer_services_id.'/comp_logo.tiff') }}" width="200" height="200">
                        @endif

                    </div>
                </div>

                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="shopname">APP Shop Name:</label>
                        <input type="text" seq="2" class="form-control enterseq" id="shopname" name="shopname" value="{{ $totalpayapp->shopname }}" maxlength="100"/>
                        <span class="text-danger">{{ $errors->first('shopname') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="contactno">APP Shop Contact No:</label>
                        <input type="text" seq="3" class="form-control enterseq" id="contactno" name="contactno" value="{{ $totalpayapp->contactno }}" maxlength="100"/>
                        <span class="text-danger">{{ $errors->first('contactno') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="email">APP Shop Email:</label>
                        <input type="text" seq="4" class="form-control enterseq" id="email" name="email" value="{{ $totalpayapp->email }}" maxlength="100"/>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="map_address">APP Map Address:</label>
                        <textarea seq="5" class="form-control enterseq" id="map_address" name="map_address"/>{{ $totalpayapp->map_address }}</textarea>
                        <span class="text-danger">{{ $errors->first('map_address') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="latitude">APP Google Map Latitude:</label>
                        <input type="text" seq="6" class="form-control enterseq" id="latitude" name="latitude" value="{{ $totalpayapp->latitude }}" maxlength="100"/>
                        <span class="text-danger">{{ $errors->first('latitude') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="longitude">APP Google Map Longitude:</label>
                        <input type="text" seq="7" class="form-control enterseq" id="longitude" name="longitude" value="{{ $totalpayapp->longitude }}" maxlength="100"/>
                        <span class="text-danger">{{ $errors->first('longitude') }}</span>
                    </div>
                </div>

                <div class="d-flex form-group">
                    <div class="col-4">
                        <label for="title">API URL:</label>
                        <div class="form-group d-flex">
                            <label for="tapiurl" class="col-sm-1 col-form-label">http://</label>
                            <div class="col-sm-4">
                                <span>
                                    <input type="text" seq="8" class="form-control enterseq" id="vpnaddress" name="vpnaddress" maxlength="15" value="{{ $totalpayapp->service()->first()->vpnaddress ?? '' }}">
                                </span>
                            </div>
                            <label class="col-form-label">/</label>
                            <div class="col-sm-3">
                                <input type="text" seq="9" class="form-control enterseq" id="tapiurl" name="tapiurl" value="{{ $totalpayapp->tapiurl ?? '' }}" maxlength="100">
                            </div>
                            <label for="tapiurl" class="col-sm-1 col-form-label">/totalpay</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex form-group">
                    <div class="col-2">
                        <label for="renew_red">Repawn / Redeem / Both :</label>
                        <select seq="10" class="form-control enterseq" id="renew_red" name="renew_red">
                            <option value="0">Repawn Only</option>
                            <option value="1">Redeem Only</option>
                            <option value="2">Repawn And Redeem</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('renew_red') }}</span>
                    </div>
                    <div class="col-2 divrepawn" >
                        <label for="b_reduce_principle">Allow Reduce Principle:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_reduce_principle" name="b_reduce_principle">
                            <label name="lblb_reduce_principle" class="custom-control-label " for="b_reduce_principle"></label>
                        </div>
                    </div>
                    <div class="col-2" >
                        <label for="b_floating">Allow Payment Floating:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_floating" name="b_floating">
                            <label name="lblb_floating" class="custom-control-label " for="b_floating"></label>
                        </div>
                    </div>
                    <div class="col-2" >
                        <label for="b_payslip">Allow Bankin Slip Payment:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_payslip" name="b_payslip">
                            <label name="lblb_payslip" class="custom-control-label " for="b_payslip"></label>
                        </div>
                    </div>
                    <div class="col-2" >
                        <label for="b_productimage">Allow View Pawn Item Image:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_productimage" name="b_productimage">
                            <label name="lblb_productimage" class="custom-control-label " for="b_productimage"></label>
                        </div>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-2">
                        <label for="b_acpt_op">Online Payment:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_acpt_op" name="b_acpt_op">
                            <label name="lblb_acpt_op" class="custom-control-label " for="b_acpt_op"></label>
                        </div>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="merchant_code">IPay88 Merchant Code:</label>
                        <input type="text" seq="11" class="form-control enterseq" id="merchant_code" name="merchant_code" maxlength="50"/>
                        <span class="text-danger">{{ $errors->first('merchant_code') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="merchant_key">IPay88 Merchant Key:</label>
                        <input type="text" seq="12" class="form-control enterseq" id="merchant_key" name="merchant_key" maxlength="50"/>
                        <span class="text-danger">{{ $errors->first('merchant_key') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="chrg_amt">IPay88 Per Transaction Charges :</label>
                        <input type="text" seq="13" class="form-control enterseq" id="chrg_amt" name="chrg_amt" value="0.20" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('chrg_amt') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="cust_chrg_amt">Customer Per Transaction Charges :</label>
                        <input type="text" seq="14" class="form-control enterseq" id="cust_chrg_amt" name="cust_chrg_amt" value="0.20" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('cust_chrg_amt') }}</span>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-2">
                        <label for="b_dealforyou">Deal for you:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_dealforyou" name="b_dealforyou">
                            <label name="lblb_dealforyou" class="custom-control-label " for="b_dealforyou"></label>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="b_locate">Allow locate on map:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_locate" name="b_locate">
                            <label name="lblb_locate" class="custom-control-label " for="b_locate"></label>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="b_getgprc">Allow Get Gold Price:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_getgprc" name="b_getgprc">
                            <label name="lblb_getgprc" class="custom-control-label " for="b_getgprc"></label>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="b_refer">Allow Reference Program:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="b_refer" name="b_refer">
                            <label name="lblb_refer" class="custom-control-label " for="b_refer"></label>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="active">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" name="active" checked>
                            <label name="lblactive" class="custom-control-label " for="active"></label>
                        </div>
                    </div>
                </div>
                <div class="d-flex form-group">
                    <div class="col-6">
                        <label for="slogan">Slogan:</label>
                        <input type="text" seq="15" class="form-control enterseq" id="slogan" name="slogan" maxlength="200"/>
                        <span class="text-danger">{{ $errors->first('slogan') }}</span>
                    </div>
                </div>

                <a href="{{ url()->previous() }}?searchvalue={{ ((isset($input['searchvalue'])) ? $input['searchvalue'] : '') }}&page={{ ((isset($input['page'])) ? $input['page'] : '') }}" class="btn btn-secondary btn-xs">
                    Back
                </a>
                <button type="submit" seq="16" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    <!-- Add these lines after your other JavaScript includes -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">

        var bsubmit = false;
        var custcode="{{$totalpayapp->companycode}}";
        var custid="{{$totalpayapp->customers_id}}";
        var $j = jQuery.noConflict();

        if ($j("#totalpayappform").length > 0) {
            $j("#totalpayappform").validate({
                rules: {
                    customers_id: {
                        required: true,
                        maxlength: 10
                    },
                    shopname: {
                        required: true,
                        maxlength:100
                    },
                    tapiurl: {
                        required: true,
                        maxlength:30
                    }
                },
                messages: {
                    customers_id: {
                        required: "Please enter Customer code",
                        maxlength: "Your group code maxlength should be 10 characters long."
                    },
                    shopname: {
                        required: "Please enter APP Shop Name",
                        maxlength: "The description should be 100 characters long"
                    },
                    tapiurl: {
                        required: "Please enter API URL",
                        maxlength:"The API URL should be 30 characters long"
                    }
                },
            })
        }
        $j(document).ready(function(evt){
            $j("#b_acpt_op").bind("click",function(evt){
                if($j(this).prop("checked")){
                    $j("#merchant_code").prop("readOnly",false);
                    $j("#merchant_key").prop("readOnly",false);
                    $j("#chrg_amt").prop("readOnly",false);
                    $j("#cust_chrg_amt").prop("readOnly",false);
                } else {
                    $j("#merchant_code").prop("readOnly",true);
                    $j("#merchant_key").prop("readOnly",true);
                    $j("#chrg_amt").prop("readOnly",true);
                    $j("#cust_chrg_amt").prop("readOnly",true);
                }
            })
            $j("#b_dealforyou").bind("click",function(evt){
                if($j(this).prop("checked")){
                    $j("#slogan").prop("readOnly",false);
                } else {
                    $j("#slogan").prop("readOnly",true);
                }
            })
            $j("#merchant_code").prop("readOnly",true);
            $j("#merchant_key").prop("readOnly",true);
            $j("#chrg_amt").prop("readOnly",true);
            $j("#cust_chrg_amt").prop("readOnly",true);
            $j("#slogan").prop("readOnly",true);
            @if($totalpayapp->b_acpt_op==1)
            $j("#b_acpt_op").click();
            @endif
            @if($totalpayapp->b_dealforyou==1)
            $j("#b_dealforyou").click();
            @endif
            @if($totalpayapp->b_locate==1)
            $j("#b_locate").prop("checked",true);
            @else
            $j("#b_locate").prop("checked",false);
            @endif
            @if($totalpayapp->b_getgprc==1)
            $j("#b_getgprc").prop("checked",true);
            @else
            $j("#b_getgprc").prop("checked",false);
            @endif
            @if($totalpayapp->b_refer==1)
            $j("#b_refer").prop("checked",true);
            @else
            $j("#b_refer").prop("checked",false);
            @endif
            @if($totalpayapp->active==1)
            $j("#active").prop("checked",true);
            @else
            $j("#active").prop("checked",false);
            @endif
            @if($totalpayapp->b_reduce_principle==1)
            $j("#b_reduce_principle").prop("checked",true);
            @else
            $j("#b_reduce_principle").prop("checked",false);
            @endif
            @if($totalpayapp->b_floating==1)
            $j("#b_floating").prop("checked",true);
            @else
            $j("#b_floating").prop("checked",false);
            @endif
            @if($totalpayapp->b_payslip==1)
            $j("#b_payslip").prop("checked",true);
            @else
            $j("#b_payslip").prop("checked",false);
            @endif
            @if($totalpayapp->b_productimage==1)
            $j("#b_productimage").prop("checked",true);
            @else
            $j("#b_productimage").prop("checked",false);
            @endif

            //$j("#vpnaddress").val("{{$totalpayapp->vpnaddress}}");
            //$j("#serviceid").val("{{$totalpayapp->serviceid}}");
            $j("#merchant_code").val("{{$totalpayapp->merchant_code}}");
            $j("#merchant_key").val("{{$totalpayapp->merchant_key}}");
            $j("#chrg_amt").val("{{$totalpayapp->chrg_amt}}");
            $j("#cust_chrg_amt").val("{{$totalpayapp->cust_chrg_amt}}");
            $j("#contactno").val("{{$totalpayapp->contactno}}");
            $j("#slogan").val("{{$totalpayapp->slogan}}");
            $j("#renew_red").val("{{$totalpayapp->renew_red}}");
            $j(".enterseq").each(function(i){
                $j(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($j(this).is("button[type='submit']")) {
                                $j(this).click();
                                return false;
                            }
                            var dd = parseInt($j(this).attr("seq"),10)+1;
                            if( $j(".enterseq").filter("[seq='"+dd+"']").length>0){
                                if($j(".enterseq").filter("[seq='"+dd+"']").is("input[type='text']")) {
                                    $j("input[type='text']").filter("[seq='"+dd+"']").select();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("input[type='number']")) {
                                    $j("input[type='number']").filter("[seq='"+dd+"']").select();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $j("select").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("checkbox")){
                                    $j("checkbox").filter("[seq='"+dd+"']").select();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $j("button").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("label")){
                                    $j("label").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("a")){
                                    $j("a").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            return false;
                            break;
                        case 38:
                            var ded = ($j(this).is("input[type='checkbox']"))?2:1;
                            var dd = (parseInt($j(this).attr("seq"),10)>0)?(parseInt($j(this).attr("seq"),10)-ded):parseInt($j(this).attr("seq"),10);

                            while(dd>0){
                                if($j("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                    $j("input[type='text']").filter("[seq='"+dd+"']").select();
                                    dd=0;
                                } else if($j("select").filter("[seq='"+dd+"']").length>0){
                                    $j("select").filter("[seq='"+dd+"']").focus();
                                    dd=0;
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("label")){
                                    $j("label").filter("[seq='"+dd+"']").focus();
                                    dd=0;
                                }
                                dd--;
                            }
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
            // $j('.customerAutoSelect').autoComplete({minLength:2,
            //     events: {
            //         searchPost: function (resultFromServer) {
            //             setTimeout(function(){
            //                 $j('.customerAutoSelect').next().find('a').eq(0).addClass("active");
            //             },100)
            //             return resultFromServer;
            //         }
            //     }
            // });
            $j('.customerAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    return false;
                }
            })
            $j('.customerAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    if($j('.customerAutoSelect').val()==""){
                        $j('.customerAutoSelect').focus();
                    } else {
                        var ss = $j('.customerAutoSelect').val().split("->");
                        $j('.customerAutoSelect').val(ss[0]);
                    }
                },300);
                return false;
            });
            $j('.customerAutoSelect').on('autocomplete.select', function (e, datum) {
                $j('.customerAutoSelect').parent().find("div.dropdown-menu").empty();
                $j("#vpnaddress").html(datum.vpnaddress);
                $j("#shopname").val(datum.companyname);
                $j("#serviceid").val(datum.serviceid);
                $j(this).change();
                return false;
            })

            $j('.customerAutoSelect').blur(function(evt){
                if($j('.customerAutoSelect').val()=="" && custcode!=""){
                    $j("input[name='customerid_text']").val(custcode);
                    $j("input[name='customers_id']").val(custid);
                }
            })
            setTimeout(function(){
                $j("input[name='customerid_text']").val(custcode);
                $j("input[name='customers_id']").val(custid);
                $j('.customerAutoSelect').select();
            },200);

            $j('.customerAutoSelect').select2({
                placeholder: 'Customer search',
                minimumInputLength: 2 // Minimum characters to start searching
            });

        });

        function js_validate_alphanumeric(e) {
            var keyChar = String.fromCharCode(e.which || e.keyCode);
            return js_valid_alpha(keyChar);
        }

        function js_valid_alpha(charc) {
            var alpha = /[A-Za-z0-9]/;
            return alpha.test(charc) ? charc : false;
        }
    </script>
@endsection
