@extends('layouts.app')

@section('styles')
    <link href="{{ asset('js/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading START -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Group</h1>
            </div>
            <!-- Page Heading END -->
            @include('partials/messages')

            <form id="groupform" method="post" action="{{ action('App\Http\Controllers\CustomerGroupsController@update', $customer_group->id) }}" >
                @csrf
                @method('PUT')

                <input name="_method" type="hidden" value="PATCH">
                <input name="lastrunno" type="hidden" value="{{(($customer_group->category)?$customer_group->category->lastrunno:"")}}">
                <input name="categorycode" type="hidden" value="{{(($customer_group->category)?$customer_group->category->categorycode:"")}}">
                <div class="row form-group">
                    <div class="col-6">
                        <label for="groupcode">Group Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" name="groupcode" value="{{$customer_group->groupcode}}" maxlength="20" />
                        <span class="text-danger">{{ $errors->first('groupcode') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Description:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="description" value="{{$customer_group->description}}" maxlength="200" />
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="system_id">System ID: <span style="color:red;">*</span>:</label>
                        <select class="form-control enterseq" seq="3" name="category_id">
                            <option value=""> -- Selection --</option>
                            @if($categorylist)
                                @foreach ($categorylist as $rcatg)
                                    <option value="{{$rcatg['id']}}" {{ (($rcatg['id']==$customer_group['customer_categories_id'])?"selected":"") }}>{{$rcatg['description']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="companyid">Bill From Company: <span style="color:red;">*</span>:</label>
                        <select class="form-control enterseq" seq="4" name="companyid">
                            <option value=""> -- Selection --</option>
                            @if($companylist)
                                @foreach ($companylist as $rcompany)
                                    <option value="{{$rcompany['id']}}" {{ (($rcompany['id']==$customer_group['companyid'])?"selected":"") }}>{{$rcompany['companycode']." - ".$rcompany['companyname']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="companyid">Service Form Folder Name: :</label>
                        <input type="text" seq="5" class="form-control enterseq" name="foldername" value="{{$customer_group->foldername}}" maxlength="200" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-4">
                        <label for="title">Customers:</label>
                        <select class="form-control customerAutoSelect enterseq overflow-ellipsis" seq="6" name="customerid"
                                placeholder="Customer search"
                                autocomplete="off">
                        </select>
                    </div>
                    <div class="col-4">
                        <br>
                        <label for="title"><span class="cfgpass">
                    @if($customer_group->cfgpassword!="")
                                    <a href="javascript:void(0);" onclick="js_openfile('{{ url('/').$customer_group->cfgfile }}');">{{$customer_group->cfgpassword}}</a>
                                    <a href="javascript:void(0);" onclick="js_remove_cfg('{{$customer_group->id}}')" class="btn btn-danger">Remove</a>
                        </span>  &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        @else
                            </span>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        @endif
                        <a href="javascript:void(0);" onclick="js_serial_act()" class="btn btn-primary">CFG</a>
                        <a href="javascript:void(0);" onclick="js_print_page()" class="btn btn-primary">Print</a>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <table class="table" id="tblcust">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th></th>
                                <th>
                                    <select class="form-control" name="allcontract_typ">
                                        <option value="">-- Selection --</option>
                                        <option value="1">Yearly</option>
                                        <option value="2">Monthly</option>
                                        <option value="3">Bi-Monthly</option>
                                        <option value="4">Half Yearly</option>
                                        <option value="5">Quarterly</option>
                                    </select>
                                </th>
                                <th><input type="text" class="form-control" name="allamount" onKeyPress="return js_validate_amt_dec(event);"></th>
                                <th>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="allinc_hw" value="N">
                                        <input type="checkbox" class="custom-control-input enterseq" name="allcinc_hw" id="cinc_hw">
                                        <label class="custom-control-label enterseq" for="allinc_hw"></label>
                                    </div>
                                </th>
                                <th>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="allpay_before" value="N">
                                        <input type="checkbox" class="custom-control-input enterseq" name="allcpay_before" id="cpay_before">
                                        <label class="custom-control-label enterseq" for="allpay_before"></label>
                                    </div>
                                </th>
                                <th>
                                    <button type="button" class="btn btn-primary" id="btnSaveAllServ">Save</button>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th>Customers</th>
                                <th>Period Type</th>
                                <th>Amount</th>
                                <th>Include Hardware [Y/N]</th>
                                <th>Pay Before Service[Y/N]</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Service<br>Pay Date</th>
                                <th>Software License Per PC</th>
                                <th>VPN Address</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($groupdetail->exists())
                                @php
                                    $ilp=0;
                                @endphp
                                @foreach ($groupdetail->get() as $nd=> $rdet)
                                    @if($rdet->customer)
                                        @php
                                            $ilp++;
                                        @endphp
                                        <tr>
                                            <td scope="row"><input type='hidden' name='detid[]' value='{{$rdet->id}}'><input type='hidden' name='cust[]' value='{{$rdet->customerid}}'><span>{{$ilp}}</span></td>
                                            @if($rdet->customerservices($customer_group->categoryid)->exists())
                                                <td><a href="javascript:void(0);" onclick="js_edit_service('{{(($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->id:"")}}')">{{ (($rdet->customer->exists())?$rdet->customer->companycode."-".$rdet->customer->companyname:"") }}</a></td>
                                            @else
                                                <td>{{ (($rdet->customer->exists())?$rdet->customer->companycode."-".$rdet->customer->companyname:"") }}</td>
                                            @endif
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?(($rdet->customerservices($customer_group->categoryid)->first()->contract_typ==1)?"Yearly":(($rdet->customerservices($customer_group->categoryid)->first()->contract_typ==2)?"Monthly":(($rdet->customerservices($customer_group->categoryid)->first()->contract_typ==3)?"Bi-Monthly":(($rdet->customerservices($customer_group->categoryid)->first()->contract_typ==4)?"Half Yearly":(($rdet->customerservices($customer_group->categoryid)->first()->contract_typ==5)?"Quarterly":""))))):"") }}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->amount:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->inc_hw:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->pay_before:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->start_date:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->end_date:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->service_date:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->soft_license:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->vpnaddress:"")}}</td>
                                            <td>{{ (($rdet->customerservices($customer_group->categoryid)->exists())?$rdet->customerservices($customer_group->categoryid)->first()->active:"")}}</td>
                                            <td class="text-center ">
                                                <button class="btn btn-danger" type="button" onclick="js_delete(this);">Delete</button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr class="empty">
                                    <td class="text-center" colspan="3">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\CustomerGroupsController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a> <button type="submit" seq="7" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/select2/dist/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#groupform").length > 0) {
            $j("#groupform").validate({
                rules: {
                    groupcode: {
                        required: true,
                        maxlength: 20
                    },
                    description: {
                        required: true,
                        maxlength:200
                    },
                    category_id:{
                        required: true,
                    },
                    companyid:{
                        required: true,
                    }
                },
                messages: {
                    groupcode: {
                        required: "Please enter group code",
                        maxlength: "Your group code maxlength should be 20 characters long."
                    },
                    description: {
                        required: "Please enter description",
                        maxlength: "The description should be 200 characters long"
                    },
                    category_id:{
                        required: "Please select system id",
                    },
                    companyid:{
                        required: "Please select company",
                    }
                },
            })
            $j("#groupform").submit(function(evt){
                $j("input[type='text']").each(function(i){
                    $j(this).val($j(this).val().toUpperCase());
                })
                var input = $j("<input>").attr("name", "agentid").attr("type", "hidden").val($j("input[name='agentid']").val());
                $j('#groupform').append($j(input));
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
                            if($j(this).attr("name")=="description"){
                                $j("select[name='category_id']").focus();
                            } else if($j(this).attr("name")=="category_id"){
                                $j(".customerAutoSelect").focus();
                            } else {
                                var dd = parseInt($j(this).attr("seq"),10)+1;
                                if( $j(".enterseq").filter("[seq='"+dd+"']").length>0){
                                    if($j(".enterseq").filter("[seq='"+dd+"']").is("input")) {
                                        $j("input[type='text']").filter("[seq='"+dd+"']").select();
                                    } else if($j(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                        $j("select").filter("[seq='"+dd+"']").focus();
                                    } else if($j(".enterseq").filter("[seq='"+dd+"']").is("checkbox")){
                                        $j("checkbox").filter("[seq='"+dd+"']").select();
                                    } else if($j(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                        $j("button").filter("[seq='"+dd+"']").focus();
                                    }
                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($j(this).attr("seq"),10)>0)?(parseInt($j(this).attr("seq"),10)-1):parseInt($j(this).attr("seq"),10);
                            if($j("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                $j("input[type='text']").filter("[seq='"+dd+"']").select();;
                            } else if($j("select").filter("[seq='"+dd+"']").length>0){
                                $j("select").filter("[seq='"+dd+"']").focus();;
                            }
                    }
                    if(keycode==13)
                        return false;
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
            $j("select[name='category_id']").bind("change",function(evt){
                data="categoryid="+$j(this).val();
                $j.ajax({
                    url:"{{action('App\Http\Controllers\CustomerGroupsController@categorylist')}}",
                    data: data,
                    dataType: "json"
                }).done(function( data ) {
                    $j("input[name='lastrunno']").val(data.lastrunno);
                    $j("input[name='categorycode']").val(data.categorycode);
                })
            })
            // $j('.customerAutoSelect').autoComplete({minLength:2,
            //     events: {
            //         searchPost: function (resultFromServer) {
            //             setTimeout(function(){
            //                 if(!$j('.customerAutoSelect').next().find('a').eq(0).hasClass("disabled")){
            //                     $j('.customerAutoSelect').next().find('a').eq(0).addClass("active");
            //                 }
            //             },100)
            //             return resultFromServer;
            //         }
            //     }
            // });
            const customers = @json($customers);
            $j('.customerAutoSelect').select2({
                data: customers,
                placeholder: 'Select a customer',
                allowClear: true, // Adds a clear button
                multiple: false   // Ensures single select behavior
            });

            // Event listener for the change event of the select element
            $j('.customerAutoSelect').on('change', function () {
                const selectedCustomerId = $j(this).val();

                // Replace 'customers' with the actual data source containing the customer details
                const datum = customers.find(customer => customer.id === selectedCustomerId);

                if (datum) {

                }
            });


            $j('.customerAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    if($j(this).val()==""){
                        setTimeout(function(){
                            $j("button").filter("[seq='6']").focus();
                        },500);
                    }
                    return false;
                }
            })
            $j('.customerAutoSelect').on('change', function (e, datum) {
                const selectedCustomerId = $j(this).val();
                if($j("input[name='customerid']").val()!=""){
                    var data="categoryid="+$j("select[name='category_id']").val()+"&customerid="+selectedCustomerId;
                    $j.ajax({
                        url: "{{ route('customer-groups.custservice') }}",
                        type:'get',
                        dataType: 'json',
                        data:data,
                        beforeSend: function(){
                            $j('#modalLoading').modal('show');
                        },
                        success: function(json){
                            setTimeout(function(){ $j("#modalLoading .close").click(); },500);
                            js_add_customer(json,$j('.customerAutoSelect').val());
                            $j('.customerAutoSelect').select();
                            $j('.customerAutoSelect').next().find("a").remove();
                            return false;
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            setTimeout(function(){ $j("#modalLoading .close").click(); },500);
                            $j('.customerAutoSelect').blur();
                            $j('.customerAutoSelect').next().find("a").remove();
                            $j("input[name='customerid_text']").val('');
                            $j("span.errormsg").html("This customer didnt have "+$j("select[name='category_id'] option:selected").text()+" service! Please add customer service!");
                            $j('#modalErrorMsg').modal('show');
                            return false;
                        }
                    })
                } else {
                    alert("Invalid Customer!");
                }
                return false;
            });
            $j('#modalErrorMsg').on('hidden.bs.modal', function () {
                $j('.customerAutoSelect').select();
                return false;
            });
            $j('.customerAutoSelect').on('autocomplete.select', function (e, datum) {
                $j(this).change();
                return false;
            })

            $j("input[name='fileupload']").bind("change",function(evt){
                var formd = new FormData();
                formd.append("_token", $j("input[name='_token']").val());
                formd.append("hidAction", "uploadcfg");
                formd.append("catg", $j("input[name='categorycode']").val());
                formd.append("id", $j("input[name='groupcode']").val());
                formd.append("compnam", $j("input[name='description']").val());
                formd.append("cfg_file",$j(this).get(0).files[0]);
                $j.ajax({
                    url: "{{action('App\Http\Controllers\CustomerGroupsController@store')}}",
                    type: "POST",
                    data: formd,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false   // tell jQuery not to set contentType
                }).done(function( data ) {
                    if(data.msg!=undefined){
                        alert(data.msg);
                        //$j("input[name='serial_no']").val("");
                        $j("input[name='curpassword']").val("");
                        $j("input[name='exp_dat']").val("");
                        $j(".agentAutoSelect").val("");
                        $j(".agentAutoSelect").prop("readOnly",false);
                    } else {
                        $j("input[name='exp_dat']").val(data.exp_dat);
                        $j("input[name='serial_no']").val(data.serial_no);
                        $j("input[name='curpassword']").val(data.curpassword);
                        $j("input[name='newpassword']").val(data.curpassword);
                        $j(".agentAutoSelect").val("");
                        $j(".agentAutoSelect").prop("readOnly",false);
                        $j("input[name='newpassword']").prop("readOnly",false);
                        $j(".agentAutoSelect").focus();
                    }
                    $j("input[name='fileupload']").val('');
                    return false;
                });
            })
            // $j('.agentAutoSelect').autoComplete({minLength:2,
            //     events: {
            //         searchPost: function (resultFromServer) {
            //             setTimeout(function(){
            //                 $j('.agentAutoSelect').next().find('a').eq(0).addClass("active");
            //             },100)
            //             return resultFromServer;
            //         }
            //     }
            // });
            $j('.agentAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    if(!$j("input[name='newpassword']").prop("readOnly")){
                        $j("input[name='newpassword']").select();
                    } else {
                        $j('#btnSaveSerial').focus();
                    }

                    return false;
                } else if(keycode==38){
                    $j("input[name='exp_dat']").select();
                    return false;
                }
            })
            $j('.agentAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    if($j('.agentAutoSelect').val()==""){
                        $j('.agentAutoSelect').focus();
                    } else {
                        if($j("input[name='newpassword']").prop('readonly')){
                            $j('#btnSaveSerial').focus();
                        } else {
                            $j("input[name='newpassword']").select();
                        }
                    }
                },300);
                return false;
            });
            $j('.agentAutoSelect').on('autocomplete.select', function (e, datum) {
                $j(this).change();
                return false;
            })
            $j("input[name='serial_no']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("input[name='exp_dat']").select();
                    return false;
                }
            })
            $j("input[name='exp_dat']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    js_date_format($j(this));
                    $j('.agentAutoSelect').focus();
                    return false;
                } else if(keycode==38){
                    $j("input[name='serial_no']").select();
                    return false;
                }
            })
            $j("input[name='newpassword']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j('#btnSaveSerial').focus();
                    return false;
                } else if(keycode==38){
                    if(!$j(".agentAutoSelect").prop("readOnly")){
                        $j(".agentAutoSelect").select();
                    }
                    return false;
                }
            })
            $j('#btnSaveSerial').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j(this).click();
                    return false;
                }
            })
            $j('#btnSaveSerial').click(function(event){
                data = "_token="+$j("input[name='_token']").val();
                data +="&hidAction=savecfg";
                data +="&category_id="+$j("select[name='category_id']").val();
                data +="&companycode="+$j("input[name='groupcode']").val();
                data +="&system_id="+$j("input[name='categorycode']").val();
                data +="&serial_no="+$j("input[name='serial_no']").val();
                data +="&exp_dat="+$j("input[name='exp_dat']").val();
                data +="&curpassword="+$j("input[name='curpassword']").val();
                data +="&newpassword="+$j("input[name='newpassword']").val();
                data +="&companyname="+$j("input[name='description']").val();
                data +="&soft_lic="+$j("input[name='soft_lic']").val();
                data +="&groupid={{$customer_group->id}}";
                if($j("input[name='serial_no']").val()==""){
                    $j("input[name='serial_no']").select();
                    return false;
                }
                if($j("input[name='exp_dat']").val()==""){
                    $j("input[name='exp_dat']").select();
                    return false;
                }
                $j.ajax({
                    url:"{{action('App\Http\Controllers\CustomerGroupsController@store')}}",
                    type:'post',
                    dataType: 'json',
                    data:data,
                    beforeSend: function(){
                        $j('#modalLoading').modal('show');
                    },
                    success: function(json){
                        setTimeout(function(){ $j("#modalLoading .close").click(); },100);
                        alert(json.msg);
                        if(json.newpassword!=undefined){
                            $j("input[name='curpassword']").val(json.newpassword);
                            $j("input[name='newpassword']").val(json.newpassword);
                        } else {
                            $j("#serializationModal .close").click();
                        }
                        $j("input[name='newpassword']").prop("readOnly",false);
                        $j("input[name='newpassword']").select();

                        return false;
                    }
                });
            })
            $j(".custom-switch").click(function(evt){
                if($j("input[name='"+$j(this).find("input[type='checkbox']").attr("name")+"']").prop("checked")){
                    $j("input[name='"+$j(this).find("input[type='checkbox']").attr("name")+"']").prop("checked",false);
                    $j(this).find("input[type='hidden']").val("N");
                } else {
                    $j("input[name='"+$j(this).find("input[type='checkbox']").attr("name")+"']").prop("checked",true);
                    $j(this).find("input[type='hidden']").val("Y");
                }
                return false;
            })
            $j("select[name='contract_typ']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("input[name='amount']").select();
                    return false;
                }
            })
            $j("input[name='amount']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("input[name='start_date']").select();
                    return false;
                } else if(keycode==38){
                    $j("select[name='contract_typ']").select();
                    return false;
                }
            })
            /*$j("input[name='inc_hw']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("label[for='pay_before']").focus();
                    return false;
                } else if(keycode==38){
                    $j("select[name='amount']").select();
                    return false;
                }
            })
            $j("input[name='pay_before']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("input[name='start_date']").select();
                    return false;
                } else if(keycode==38){
                    $j("label[for='inc_hw']").focus();
                    return false;
                }
            })*/
            $j("input[name='start_date']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    js_date_format($j(this));
                    if($j(this).val()!=""){
                        if($j("select[name='contract_typ']").val()=="1") {
                            var dt = new Date($j(this).val().substr(6,4),(parseInt($j(this).val().substr(3,2),10)-1),$j(this).val().substr(0,2) );
                            var ndt = add_years(dt,1);
                            $j("input[name='end_date']").val(ndt.getDate().toString().padStart(2,"0")+"/"+(ndt.getMonth()+1).toString().padStart(2,"0")+"/"+ndt.getFullYear());
                        } else if($j("select[name='contract_typ").val()=="2") {
                            var dt = new Date($j(this).val().substr(6,4),(parseInt($j(this).val().substr(3,2),10)-1),$j(this).val().substr(0,2) );
                            var ndt = add_months(dt,1);
                            $j("input[name='end_date']").val(ndt.getDate().toString().padStart(2,"0")+"/"+(ndt.getMonth()+1).toString().padStart(2,"0")+"/"+ndt.getFullYear());
                        } else if($j("select[name='contract_typ']").val()=="3") {
                            var dt = new Date($j(this).val().substr(6,4),(parseInt($j(this).val().substr(3,2),10)-1),$j(this).val().substr(0,2) );
                            var ndt = add_months(dt,2);
                            $j("input[name='end_date']").val(ndt.getDate().toString().padStart(2,"0")+"/"+(ndt.getMonth()+1).toString().padStart(2,"0")+"/"+ndt.getFullYear());
                        } else if($j("select[name='contract_typ']").val()=="4") {
                            var dt = new Date($j(this).val().substr(6,4),(parseInt($j(this).val().substr(3,2),10)-1),$j(this).val().substr(0,2) );
                            var ndt = add_months(dt,6);
                            $j("input[name='end_date']").val(ndt.getDate().toString().padStart(2,"0")+"/"+(ndt.getMonth()+1).toString().padStart(2,"0")+"/"+ndt.getFullYear());
                        } else if($j("select[name='contract_typ']").val()=="5") {
                            var dt = new Date($j(this).val().substr(6,4),(parseInt($j(this).val().substr(3,2),10)-1),$j(this).val().substr(0,2) );
                            var ndt = add_months(dt,3);
                            $j("input[name='end_date']").val(ndt.getDate().toString().padStart(2,"0")+"/"+(ndt.getMonth()+1).toString().padStart(2,"0")+"/"+ndt.getFullYear());
                        }
                    }
                    if($j("input[name='pay_before']").val()=="Y"){
                        $j("input[name='service_date']").val($j(this).val());
                    } else {
                        var dt = new Date($j("input[name='end_date']").val().substr(6,4),(parseInt($j("input[name='end_date']").val().substr(3,2),10)-1),$j("input[name='end_date']").val().substr(0,2));
                        var ndt = add_dates(dt,1);
                        $j("input[name='service_date']").val(ndt.getDate().toString().padStart(2,"0")+"/"+(ndt.getMonth()+1).toString().padStart(2,"0")+"/"+ndt.getFullYear());
                    }
                    $j("input[name='end_date']").select();
                    return false;
                } else if(keycode==38){
                    $j("input[name='amount']").select();
                    return false;
                }
            })
            $j("input[name='end_date']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    js_date_format($j(this));
                    $j("input[name='service_date']").select();
                    return false;
                } else if(keycode==38){
                    $j("input[name='start_date']").select();
                    return false;
                }
            })
            $j("input[name='service_date']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    js_date_format($j(this));
                    $j("input[name='soft_license']").select();
                    return false;
                } else if(keycode==38){
                    $j("input[name='end_date']").select();
                    return false;
                }
            })
            $j("input[name='soft_license']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("input[name='vpnaddress']").select();
                    return false;
                } else if(keycode==38){
                    $j("input[name='service_date']").select();
                    return false;
                }
            })
            $j("input[name='vpnaddress']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("#btnSaveServices").focus();
                    return false;
                } else if(keycode==38){
                    $j("input[name='soft_license']").select();
                    return false;
                }
            })
            $j("#btnSaveServices").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j(this).click();
                    return false;
                } else if(keycode==38){
                    $j("input[name='vpnaddress']").select();
                    return false;
                }
            })
            $j("#btnSaveServices").click(function(event){
                var data=$j('#custservices').serialize();

                $j.ajax({
                    url: "{{action('App\Http\Controllers\CustomerGroupsController@savecustservice')}}",
                    type:'post',
                    dataType: 'json',
                    data:data,
                    success: function(json){
                        $j("#servicesModal .close").click();
                        alert(json.msg);
                        window.location.reload();
                        return false;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Save Service Error!");
                        return false;
                    }
                })
                return false;
            })
            $j("#btnSaveAllServ").click(function(event){
                var data="contract_typ="+$j('select[name="allcontract_typ"]').val();
                data+="&amount="+$j("input[name='allamount']").val();
                data+="&inc_hw="+$j("input[name='allinc_hw']").val();
                data+="&pay_before="+$j("input[name='allpay_before']").val();
                data+="&groupid={{$customer_group->id}}";
                data+="&categoryid="+$j("select[name='category_id']").val();
                $j.ajax({
                    url: "{{action('App\Http\Controllers\CustomerGroupsController@savegroupcustservice')}}",
                    type:'post',
                    dataType: 'json',
                    data:data,
                    success: function(json){
                        $j("#servicesModal .close").click();
                        alert(json.msg);
                        window.location.reload();
                        return false;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Save Service Error!");
                        return false;
                    }
                })
                return false;
            })
            /*$j("input[name='active']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("#btnSaveServices").focus();
                    return false;
                } else if(keycode==38){
                    $j("input[name='soft_license']").select();
                    return false;
                }
            })*/
        })
        function js_edit_service(id){
            if(id!=""){
                var data="serviceid="+id;
                $j.ajax({
                    url: "route('customer-groups.custservice')",
                    type:'get',
                    dataType: 'json',
                    data:data,
                    beforeSend: function(){
                        //$j('#modalLoading').modal('show');
                    },
                    success: function(json){
                        //$j("#modalLoading .close").click();
                        $j("#servicesModal").modal("show");
                        $j("select[name='contract_typ']").val(json.contract_typ);
                        $j("input[name='amount']").val(json.amount);
                        $j("input[name='serviceid']").val(json.id);
                        $j("input[name='inc_hw']").val(json.inc_hw);
                        if(json.inc_hw=="Y"){
                            if(!$j("input[name='cinc_hw']").prop("checked")) {
                                $j("input[name='cinc_hw']").parent().click();
                            }
                        } else {
                            if($j("input[name='cinc_hw']").prop("checked")) {
                                $j("input[name='cinc_hw']").parent().click();
                            }
                        }
                        $j("input[name='pay_before']").val(json.pay_before);
                        if(json.pay_before=="Y"){
                            if(!$j("input[name='cpay_before']").prop("checked")) {
                                $j("input[name='cpay_before']").parent().click();
                            }
                        } else {
                            if($j("input[name='cpay_before']").prop("checked")) {
                                $j("input[name='cpay_before']").parent().click();
                            }
                        }
                        $j("input[name='start_date']").val(json.start_date);
                        $j("input[name='end_date']").val(json.end_date);
                        $j("input[name='service_date']").val(json.service_date);
                        $j("input[name='soft_license']").val(json.soft_license);
                        $j("input[name='vpnaddress']").val(json.vpnaddress);
                        $j("input[name='active']").val(json.active);
                        if(json.active=="Y"){
                            if(!$j("input[name='cactive']").prop("checked")) {
                                $j("input[name='cactive']").parent().click();
                            }
                        } else {
                            if($j("input[name='cactive']").prop("checked")) {
                                $j("input[name='cactive']").parent().click();
                            }
                        }
                        setTimeout(function(){ $j("select[name='contract_typ']").focus(); },500);
                        return false;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        setTimeout(function(){ $j("#modalLoading .close").click(); },500);
                        alert("Invalid Services!");
                        return false;
                    }
                })
            }
        }
        function js_remove_cfg(id){
            data = "_token="+$j("input[name='_token']").val();
            data +="&hidAction=deletecfg";
            data +="&group_id="+id;
            $j.ajax({
                url:"{{action('App\Http\Controllers\CustomerGroupsController@store')}}",
                type:'post',
                dataType: 'json',
                data:data,
                beforeSend: function(){
                    $j('#modalLoading').modal('show');
                },
                success: function(json){
                    setTimeout(function(){ $j("#modalLoading .close").click(); },100);
                    alert(json.msg);
                    window.location.reload();
                    return false;
                }
            });
        }
        function js_openfile(file){
            window.open(file,'downloadfile');
        }
        function js_add_customer(data, name){
            if( $j("table#tblcust tbody tr.empty").length>0){
                $j("table#tblcust tbody tr.empty").remove();
            }
            var bcheck=false;
            $j("input[name='cust[]']").each(function(i){
                if($j(this).val()==data.customerid){
                    bcheck=true;
                }
            })
            if(!bcheck) {
                var ncount=$j("table#tblcust tbody tr").length;
                var trrow="<tr>";
                trrow+="<td scope=\"row\"><input type='hidden' name='cust[]' value='"+data.customerid+"'><span>"+(ncount+1)+"</span></td>";
                if(data.id!="") {
                    trrow+="<td><a href=\"javascript:void(0);\" onclick=\"js_edit_service('"+data.id+"')\">"+name+"</a></td>";
                } else {
                    trrow+="<td>"+name+"</td>";
                }
                trrow+="<td>"+((data.contract_typ=="1")?"Yearly":((data.contract_typ=="2")?"Monthly":((data.contract_typ=="3")?"Bi-Monthly":((data.contract_typ=="4")?"Half Yearly":((data.contract_typ=="5")?"Quarterly":"")))))+"</td>";
                trrow+="<td>"+data.amount+"</td>";
                trrow+="<td>"+data.inc_hw+"</td>";
                trrow+="<td>"+data.pay_before+"</td>";
                trrow+="<td>"+data.start_date+"</td>";
                trrow+="<td>"+data.end_date+"</td>";
                trrow+="<td>"+data.service_date+"</td>";
                trrow+="<td>"+data.soft_license+"</td>";
                trrow+="<td>"+data.vpnaddress+"</td>";
                trrow+="<td>"+data.active+"</td>";
                trrow+="<td class=\"text-center\">";
                trrow+="<button class=\"btn btn-danger\" type=\"button\" onclick=\"js_delete(this);\">Delete</button>";
                trrow+="</td>";
                trrow+="</tr>";
                $j("table#tblcust tbody").append(trrow);
                $j(".customerAutoSelect").select();
                $j('.customerAutoSelect').val('');
                $j(".dropdown-menu").empty();
            }
            $j(".customerAutoSelect").val('');
            $j("input[name='customerid']").val('');

            return false;
        }
        function js_delete(obj){
            $j(obj).parent().parent().remove();
            if($j("table#tblcust tbody tr").length>0){
                $j("table#tblcust tbody tr").each(function(i){
                    $j(this).find("td").eq(0).find('span').html((i+1));
                })
            } else {
                var trrow = "<tr class=\"empty\">";
                trrow += "<td class=\"text-center\" colspan=\"12\">No Record Found</td>";
                trrow += "</tr>";
                $j("table#tblcust tbody").append(trrow);
            }
            return false;
        }
        function js_serial_act(){
            $j("input[name='customername']").val($j("input[name='description']").val());

            $j("#serializationModal").modal("show");
            if($j("input[name='serial_no']").val()!="") {
                $j("input[name='serial_no']").prop("readOnly",true);
                $j("input[name='exp_dat']").prop("readOnly",true);
                if("{{$customer_group->agentid}}"!="") {
                    $j("input[name='agentid']").val("{{$customer_group->agentid}}");
                    $j(".agentAutoSelect").val("{{(($customer_group->agent)?$customer_group->agent->agentcode."-".$customer_group->agent->name:"")}}");
                    $j("input[name='agentid']").prop("readOnly",true);
                    $j(".agentAutoSelect").prop("readOnly",true);
                } else {
                    $j(".agentAutoSelect").prop("readOnly",false);
                    $j("input[name='agentid']").prop("readOnly",false);
                }
                $j("input[name='newpassword']").prop("readOnly",false);
                setTimeout(function(){ $j("input[name='newpassword']").select(); },1000);
            } else {
                var lastrunno=$j("input[name='lastrunno']").val();
                $j("input[name='serial_no']").val(parseInt(lastrunno,10)+1);
                $j("input[name='serial_no']").prop("readOnly",false);
                $j("input[name='exp_dat']").prop("readOnly",false);
                $j("input[name='agentid']").prop("readOnly",false);
                setTimeout(function(){ $j("input[name='serial_no']").select(); },1000);
            }
        }
        function js_date_format(obj,check18) {
            check18 = (check18==undefined)?"N":check18;
            if($j(obj).val().length>=1){
                if($j(obj).val().length==8){
                    $j(obj).val($j(obj).val().substr(0,2)+"/"+$j(obj).val().substr(2,2)+"/"+$j(obj).val().substr(4,4));
                }
                if(!checkdate($j(obj).val()) && $j(obj).val()!="") {
                    $j(obj).parent().find("label.error").empty().text('Please enter a correct date');
                    setTimeout(function(){$j(obj).select();},500);
                } else {
                    $j(obj).parent().find("label.error").empty();
                }
                if ($j(obj).val().length!=10){
                    $j(obj).val('');
                }
            }
            if(check18=="Y"){
                var age = system_datetime.substr(6,4)-$j(obj).val().substr(6,4);
                var age_mth = system_datetime.substr(3,2)-$j(obj).val().substr(3,2);
                var age_day = system_datetime.substr(0,2)-$j(obj).val().substr(0,2);
                if(age<P_Blkag || (age==P_Blkag && age_mth<0) || (age==P_Blkag && age_mth==0 && age_day<0) ){
                    if(!alert("Customer Under Age !!!")) {
                        ddd = $j(obj);
                        setTimeout("ddd.select()",500);
                        return false;
                    }
                    return false;
                }
            }
        }
        // validate date
        function checkdate(value) {
            var check = false;
            var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/
            if( re.test(value)){
                var adata = value.split('/');
                var gg = parseInt(adata[0],10);
                var mm = parseInt(adata[1],10);
                var aaaa = parseInt(adata[2],10);
                var xdata = new Date(aaaa,mm-1,gg);
                if ( ( xdata.getFullYear() == aaaa ) && ( xdata.getMonth () == mm - 1 ) && ( xdata.getDate() == gg ) )
                    check = true;
                else
                    check = false;
            } else
                check = false;
            return check;
        }
        function add_years(dt,n) {
            var fdt = new Date(dt.setFullYear(dt.getFullYear() + n));
            return new Date(fdt.setDate(fdt.getDate() - 1));
        }
        function add_months(dt,n) {
            var fdt = new Date(dt.setMonth(dt.getMonth() + n));
            return new Date(fdt.setDate(fdt.getDate() - 1));
        }
        function add_dates(dt,n){
            return new Date(dt.setDate(dt.getDate() + n));
        }
        function js_validate_amt_dec(e){
            if( e.which!=8 && e.which!=0 && e.which!=46 && (e.which<48 || e.which>57))
                return false;
            //if( e.keyCode=="46" && $j(e.target).val().substr($j(e.target).getCursorPosition(),1)=="." )
            //return false;
            setTimeout(function() {
                js_delay_validate_amt_dec($j(e.target),e.keyCode,e.which);
            }, 100)
            //setTimeout("js_delay_validate_amt_dec('"+$j(e.target)+"','"+e.keyCode+"','"+e.which+"');",100);
            if(e.which==46)
                return false;
        }
        function js_delay_validate_amt_dec(nam,keycode,keywhich,dec_point) {
            dec_point=(dec_point==undefined)?2:dec_point;
            var ss = $j(nam).val().split(".");
            if( (keycode=="46" || keycode=="8" || keycode=="0") && $j(nam).val()=="" ) {
                $j(nam).val("0.00");
                ss = $j(nam).val().split(".");
            }
            if(ss[1]==undefined || ss[1].length<dec_point){
                $j(nam).val((isNaN(parseFloat($j(nam).val()).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat($j(nam).val()).toFixed(dec_point));
                $j(nam).selectRange(ss[0].length);
            } else if(ss[1].length>=dec_point) {
                if( ($j(nam)[0].selectionStart>ss[0].length && keycode!="37") || ($j(nam)[0].selectionStart-1)>ss[0].length){
                    if(keycode=="37") {
                        $j(nam).selectRange( ($j(nam)[0].selectionStart-1), ($j(nam)[0].selectionStart) );
                    }else if(keycode=="110" || keycode=="190"){

                    } else {
                        if(ss[1].length>=dec_point) {
                            var ssdd = $j(nam).val().split(".");
                            if(dec_point=="1") {
                                $j(nam).val( (isNaN(parseFloat(Math.floor($j(nam).val()*100)/100).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat((Math.floor($j(nam).val())+String(ssdd[1])+"0")/100).toFixed(dec_point) );
                            } else {
                                $j(nam).val( (isNaN(parseFloat(Math.floor($j(nam).val()*100)/100).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat(Math.floor($j(nam).val())+String(ssdd[1])/100).toFixed(dec_point) );
                            }
                            $j(nam).selectRange(($j(nam).val().length-1),$j(nam).val().length);
                        } else {
                            $j(nam).selectRange($j(nam)[0].selectionStart, ($j(nam)[0].selectionStart+1) );
                        }
                    }
                } else if(keycode=="37" && $j(nam)[0].selectionStart>ss[0].length) {
                    $j(nam).selectRange(ss[0].length);
                } else if(ss[1].length>dec_point) {
                    $j(nam).val( (isNaN(parseFloat(Math.floor($j(nam).val()*100)/100).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat(Math.floor($j(nam).val()*100)/100).toFixed(dec_point) );
                    $j(nam).selectRange($j(nam).val().length);
                }
            }
            if(keywhich=="46"){
                $j(nam).selectRange(ss[0].length+1, (ss[0].length+2) );
            }
        }
        $j.fn.selectRange = function(start, end) {
            if(!end) end = start;
            return this.each(function() {
                if (this.setSelectionRange) {
                    this.focus();
                    this.setSelectionRange(start, end);
                } else if (this.createTextRange) {
                    var range = this.createTextRange();
                    range.collapse(true);
                    range.moveEnd('character', end);
                    range.moveStart('character', start);
                    range.select();
                }
            });
        };
        function js_print_page(){
            window.open("{{url('/')}}/customergroup/printpdffile/{{$customer_group->id}}"+"?"+Math.random().toString(36).substring(7));
        }
    </script>
@endsection
