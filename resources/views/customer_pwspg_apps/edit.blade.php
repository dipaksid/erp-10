@extends('layouts.app')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container">

            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">PWS PG APP Services</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="pwspgappform" method="post" action="{{action('App\Http\Controllers\CustomerPGAppsController@update', $id)}}" >
                @csrf
                @method('PATCH')

                <input name="userid" type="hidden" value="{{$id}}">
                <div class="row form-group">
                    <div class="col-6">
                        <label for="username">User ID:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="username" name="username" maxlength="30" value="{{$customerpwspgapp->username}}" onkeypress="return js_validate_alphanumeric(event);"/>
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="password">Password:</label>
                        <input type="text" seq="2" class="form-control enterseq" id="password" name="password" value="{{$customerpwspgapp->password}}" maxlength="30"/>
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="mob_pho">Mobile Phone No:</label>
                        <input type="text" seq="3" class="form-control enterseq" id="mob_pho" name="mob_pho" value="{{$customerpwspgapp->mob_pho}}" maxlength="20"/>
                        <span class="text-danger">{{ $errors->first('mob_pho') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="first_name">Name:</label>
                        <input type="text" seq="4" class="form-control enterseq" id="first_name" name="first_name" value="{{$customerpwspgapp->first_name}}" maxlength="30"/>
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="idle_tim">Idle Minutes:</label>
                        <input type="text" seq="5" class="form-control enterseq" id="idle_tim" name="idle_tim" value="{{$customerpwspgapp->idle_tim}}" maxlength="5"/>
                        <span class="text-danger">{{ $errors->first('idle_tim') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="access_pdf">Display PDF [Y/N]:</label>
                        <input type="text" seq="6" class="form-control enterseq" id="access_pdf" name="access_pdf" value="{{$customerpwspgapp->access_pdf}}" maxlength="1"/>
                        <span class="text-danger">{{ $errors->first('access_pdf') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="email">Email:</label>
                        <input type="text" seq="7" class="form-control enterseq" id="email" name="email" value="{{$customerpwspgapp->email}}" maxlength="60"/>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Customers:</label>
{{--                        <select class="form-control customerAutoSelect enterseq overflow-ellipsis" seq="8" name="customerid"--}}
{{--                                placeholder="Customer search"--}}
{{--                                autocomplete="off">--}}

                        <select class="form-control customerAutoSelect enterseq overflow-ellipsis" seq="8" name="customerid"
                                placeholder="Customer search"
                                autocomplete="off"></select>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="title">API URL:</label>
                        <div class="form-group row">
                            <label for="tapiurl" class="col-sm-3 col-form-label">http://<span id="vpnaddress"></span>/</label>
                            <div class="col-sm-6">
                                <input type="text" seq="9" class="form-control enterseq" id="tapiurl" name="tapiurl" value="pws" maxlength="100">
                            </div>
                            <label for="tapiurl" class="col-sm-3 col-form-label">/pgapp</label>
                        </div>

                    </div>
                    <div class="col-1">
                        <label for="title">&nbsp;</label>
                        <div class="form-group row">
                            <a class="btn" href="javascript:void(0);" onclick="js_add_customer($j('.customerAutoSelect').find(':selected').val(),$j('.customerAutoSelect').find(':selected').text())">
                                <i class="fas fa-fw fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <table class="table" id="tblcust">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th>Customer</th>
                                <th>API URL</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $arrpgappid=explode(",",$customerpwspgapp->pgappid);
                                $arrcustomerid=explode(",",$customerpwspgapp->customerid);
                                $arrcustomer=explode(",",$customerpwspgapp->customer);
                                $arrapiurl=explode(",",$customerpwspgapp->apiurl);
                            @endphp
                            @if($arrpgappid)
                                @foreach($arrpgappid as $lkey=> $pgappid)
                                    <tr>
                                        <td scope="row"><input type='hidden' name='pgappid[]' value='{{$pgappid}}'><input type='hidden' name='cust[]' value='{{$arrcustomerid[$lkey]}}'><span>{{($lkey+1)}}</span></td>
                                        <td>{{$arrcustomer[$lkey]}}</td>
                                        <td><input type='hidden' name='apiurl[]' value='{{$arrapiurl[$lkey]}}'>{{$arrapiurl[$lkey]}}</td>
                                        <td class="text-center col-2">
                                            <button class="btn btn-danger" type="button" onclick="js_delete(this);">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="empty">
                                    <td class="text-center" colspan="4">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\CustomerPGAppsController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="10" class="btn btn-primary enterseq">Update</button>
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
        var $j = jQuery.noConflict();

        if ($j("#pwspgappform").length > 0) {
            $j("#pwspgappform").validate({
                rules: {
                    username: {
                        required: true,
                        maxlength: 30
                    },
                    first_name: {
                        required: true,
                        maxlength:100
                    },
                    password: {
                        required: true,
                        maxlength:30
                    },
                    mob_pho: {
                        required: true,
                        maxlength:20
                    }
                },
                messages: {
                    username: {
                        required: "Please enter group code",
                        maxlength: "Your group code maxlength should be 30 characters long."
                    },
                    first_name: {
                        required: "Please enter description",
                        maxlength: "The description should be 60 characters long"
                    },
                    password: {
                        required: "Please enter password",
                        maxlength:"The password should be 30 characters long"
                    },
                    mob_pho: {
                        required: "Please enter mobile phone no",
                        maxlength:"The mobile phone no should be 20 characters long"
                    }
                },
            })
            $j("#pwspgappform").submit(function(evt){
                if($j("input[name='cust[]']").length==0) {
                    alert("Customer are compulsory!");
                    $j(".customerAutoSelect").focus();
                    return false;
                }
            })
        }
        $j(document).ready(function(evt){
            $j("#username").blur(function(evt){
                if($j(this).val().length>0){
                    for(var ss=0; ss<$j(this).val().length; ss++){
                        if(!js_valid_alpha($j(this).val()[ss])){
                            $j(this).val('{{$customerpwspgapp->username}}');
                            $j(this).select();
                            return false;
                        }
                    }
                }
                return false;
            })
            $j(".enterseq").each(function(i){
                $j(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($j(this).is("input") && $j(this).attr("name")=="username"){
                                for(var ss=0; ss<$j(this).val().length; ss++){
                                    if(!js_valid_alpha($j(this).val()[ss])){
                                        $j(this).val('');
                                        $j(this).select();
                                        return false;
                                    }
                                }
                                $j(this).val($j(this).val().toUpperCase());
                            } else if($j(this).attr("name")=="tapiurl"){
                                js_add_customer($j("input[name='customerid']").val(),$j('.customerAutoSelect').val());
                                $j("#vpnaddress").html('')
                                return false;
                            } else if($j(this).is("input") && $j(this).attr("name")!="password") {
                                $j(this).val($j(this).val().toUpperCase());
                            } else if($j(this).is("button[type='submit']")) {
                                $j(this).click();
                                return false;
                            }
                            if($j(this).attr("name")=="first_name"){
                                $j(".customerAutoSelect").select();
                            } else {
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

            const customers = @json($customers);
            $j('.customerAutoSelect').select2({
                data: customers,
                placeholder: 'Select a customer',
                allowClear: true, // Adds a clear button
                multiple: false   // Ensures single select behavior
            });

            $j('.customerAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    return false;
                }
            })
            $j('.customerAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    $j('#tapiurl').select();
                },300);
                return false;
            });
            $j('.customerAutoSelect').on('autocomplete.select', function (e, datum) {
                $j('.customerAutoSelect').parent().find("div.dropdown-menu").empty();
                $j("#vpnaddress").html(datum.vpnaddress);
                $j(this).change();
                return false;
            })
        })

        function js_add_customer(id,name){

            var apiurl = "http://"+$j("#vpnaddress").html()+"/"+$j("input[name='tapiurl']").val()+"/pgapp";
            if(name!="" && id!=""){
                if( $j("table#tblcust tbody tr.empty").length>0){
                    $j("table#tblcust tbody tr.empty").remove();
                }
                var bcheck=false;
                $j("input[name='cust[]']").each(function(i){
                    if($j(this).val()==id){
                        bcheck=true;
                    }
                })
                if(!bcheck) {
                    var ncount=$j("table#tblcust tbody tr").length;
                    var trrow="<tr>";
                    trrow+="<td scope=\"row\"><input type='hidden' name='cust[]' value='"+id+"'><span>"+(ncount+1)+"</span></td>";
                    trrow+="<td>"+name+"</td>";
                    trrow+="<td><input type='hidden' name='apiurl[]' value='"+apiurl+"'>"+apiurl+"</td>";
                    trrow+="<td class=\"text-center col-2\">";
                    trrow+="<button class=\"btn btn-danger\" type=\"button\" onclick=\"js_delete(this);\">Delete</button>";
                    trrow+="</td>";
                    trrow+="</tr>";
                    $j("table#tblcust tbody").append(trrow);
                } else {
                    alert("Duplicated!");
                }
                $j("#vpnaddress").html('');
                $j(".customerAutoSelect").val('');
                $j("input[name='customerid']").val('');
                $j("#tapiurl").val("pws");
                $j(".customerAutoSelect").focus();
            }
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
                trrow += "<td class=\"text-center\" colspan=\"4\">No Record Found</td>";
                trrow += "</tr>";
                $j("table#tblcust tbody").append(trrow);
            }
            return false;
        }

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
