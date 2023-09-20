@extends('layouts.app')

@section('styles')
    <style type="text/css">
        .dropdown-menu
        {
            /*width: 800px !important;*//* you can set by percentage too */
        }
        .datepicker{
            width: auto !important;
        }

        #doStocklistModal .form-group{
            height: 400px;
            overflow: scroll;
        }

        #doStocklistModal .selected{
            background-color: #ddd;
        }

        #doCheckCustModal .modal-dialog, #doCheckInvModal .modal-dialog{
            position: fixed;
            top: 0;
            right: 10px;
            z-index: 10040;
            overflow: auto;
            overflow-y: auto;
        }
        #doCheckCustModal .form-group, #doCheckInvModal .form-group{
            height: 200px;
            overflow: auto;
            width: 600px;
        }

        .modal-backdrop.show {
            opacity: 0.05;
        }
        .modal-open { overflow-y: auto; }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Service Rate Profile</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="servicerateform" method="post" action="{{ url('services_rates') }}" >
                @csrf

                <input type="hidden" name="printdo">
                <input type="hidden" name="salesnote">
                <input type="hidden" name="printnote">
                <input type="hidden" name="salesnotelist">
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Effective Date:</label>
                        <input type="text" seq="1" class="form-control enterseq" value="{{date('d/m/Y',strtotime($services_rate->effectivedate))}}" disabled name="effectivedate" id="effectivedate" maxlength="100"/>
                    </div>
                </div>
                <table class="table table-responsive-md">
                    <thead class="thead-light">
                    <tr class="d-flex">
                        <th scope="col">#</th>
                        <th class="col-sm-8">Service Description</th>
                        <th class="col-sm-2">Rate/Trip</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $get_effective = json_decode($services_rate->description);
                    @endphp
                    @if(is_array($get_effective) && count($get_effective) > 1)
                        @foreach($get_effective as $key => $value)
                            <tr class="d-flex">
                                <td scope="col">{{$key+1}}</td>
                                <td class="col-sm-8">{{$value->description}}</td>
                                <td class="col-sm-2">{{number_format((float) $value->rate, 2)}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="d-flex">
                            <td scope="col">1</td>
                            <td class="col-sm-8">
                                {{ $get_effective->description ?? 'NA' }}
                            </td>
                            <td class="col-sm-2">
                                {{ $get_effective->rate ?? 0 }}
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <a href="{{ action('App\Http\Controllers\ServiceRatesController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
            </form>
            <!-- Modal -->
            <!-- -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/base.js') }}"></script>
    <script type="text/javascript">
        // $j("input[name='effectivedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
        //     $j(this).datepicker('hide');
        // });
        var $j = jQuery.noConflict();
        if ($j("#salesform").length > 0) {
            $j("#salesform").validate({
                rules: {
                    customerid_text: {
                        required: true
                    },
                    attention: {
                        required: true,
                        maxlength: 100
                    }
                },
                messages: {
                    customerid_text: {
                        required: "Please enter name."
                    },
                    attention: {
                        required: "Please enter attention.",
                        maxlength: "Name maxlength should be 100 characters long."
                    }
                },
            })
        }
        var bsavenote=false;
        var bsave=false;
        var fileName1="";
        var searchtrigger=false;
        var ck;
        var uomsid="";
        var prtopt="";
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
                        if($j(this).attr("name")=="salesinvoicedate"){
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
                        if($j(this).attr("name")=="referenceno"){
                            $j(".stockAutoSelect").select();
                        }
                        if($j(this).attr("name")=="en_qty" || $j(this).attr("name")=="en_unitprice" || $j(this).attr("name")=="en_discount"){
                            if($j(this).attr("name")=="en_qty" && $j(this).val()<=0){
                                $j(this).select();
                                return false;
                            }
                            js_calc_netamt();
                        }
                        if($j(this).attr("name")=="rate"){
                            js_add_item();
                            //  $j(".stockAutoSelect").select();
                        }
                        return false;
                    }
                    if(keycode==38){
                        if($j(this).attr("name")=="attention"){
                            $j(".customerAutoSelect").select();
                        }
                        if($j(this).attr("name")=="en_description"){
                            $j(".stockAutoSelect").select();
                        }
                    }
                })
            })
            ck = CKEDITOR.replace('modal_note');
            ck.on('key', function (event) {
                var keycode = (event.data.keyCode ? event.data.keyCode : event.data.which);
                if(keycode==27){
                    $j("#noteModal .close").click();
                    return false;
                } else if(keycode==113){
                    $j("#noteModal #btnSaveNote").focus();
                    return false;
                }
            })
            $j("input[name='en_note']").focus(function(evt){
                var modal = $j('#noteModal').modal({
                    backdrop: 'static',
                    keyboard: true
                });
                setTimeout(function(){
                    ck.focus();
                    if($j("input[name='en_note']").val()!=""){
                        ck.setData($j("input[name='en_note']").val());
                    } else {
                        ck.setData(" &nbsp; ");
                    }
                },1000);
                $j("#btnSaveNote").unbind('click');
                $j("#btnSaveNote").click(function(evt){
                    var data = ck.getData();
                    $j("input[name='en_note']").val(data);
                    $j("#noteModal .close").click();
                    ck.setData("");
                    return false;
                })
                $j('#noteModal').on('hidden.bs.modal', function () {
                    $j("input[name='en_qty']").select();
                })
            })
            if($j(".searchInvNo").length>0){
                $j(".searchInvNo").autoComplete({minLength:4,
                    events: {
                        searchPost: function (resultFromServer) {
                            setTimeout(function(){
                                searchtrigger=true;
                                $j('.searchInvNo').next().find('a').eq(0).addClass("active");
                            },100)
                            return resultFromServer;
                        }
                    }
                });
                $j(".searchInvNo").keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode==13){
                        if(searchtrigger) {
                            searchtrigger=false;
                            $j('.searchInvNo').val($j('.searchInvNo').val().toUpperCase());
                            $j(this).change();
                        }
                        return false;
                    }
                })
                $j('.searchInvNo').on('change', function (e, datum) {
                    setTimeout(function(){
                        if($j('.searchInvNo').val()==""){
                            $j('.searchInvNo').focus();
                        } else {
                            js_get_salesinv_info($j("input[name='srch_inv_no']").val(),$j('.searchInvNo').val());
                            $j(".dropdown-menu").empty();
                            $j(".searchInvNo").val('');
                        }
                    },300);
                    return false;
                });
            }
            $j('.stockAutoSelect').autoComplete({minLength:2,
                events: {
                    searchPost: function (resultFromServer) {
                        setTimeout(function(){
                            $j('.stockAutoSelect').next().find('a').eq(0).addClass("active");
                        },100)
                        return resultFromServer;
                    }
                }
            });
            $j('.customerAutoSelect').autoComplete({minLength:2,
                events: {
                    searchPost: function (resultFromServer) {
                        setTimeout(function(){
                            $j('.customerAutoSelect').next().find('a').eq(0).addClass("active");
                        },100)
                        return resultFromServer;
                    }
                }
            });
            $j('.customerAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("input[type='text']").filter("[seq='2']").select();
                    return false;
                }
            })
            $j('.customerAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    if($j('.customerAutoSelect').val()==""){
                        $j('.customerAutoSelect').focus();
                    } else {
                        var ss = $j('.customerAutoSelect').val().split("-");
                        $j('.customerAutoSelect').val(ss[0]);
                        js_search_customer_info($j("input[name='customerid']").val(),js_customer_callback);
                    }
                },300);
                return false;
            });
            $j('.customerAutoSelect').on('autocomplete.select', function (e, datum) {
                $j(this).change();
                return false;
            })
            $j('.stockAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j(this).change();
                    return false;
                }
                if(keycode==113){
                    $j("#btnAction").focus();
                    return false;
                }
                if(keycode==116){
                    var modal = $j('#doStocklistModal').modal({
                        backdrop: 'static',
                        keyboard: true
                    });

                    $j('#doStocklistModal').on('hidden.bs.modal', function () {
                        $j("input[name='en_description']").select();
                    })
                    return false;
                }
                if(keycode==38){
                    //$j("input[name='referenceno']").select();
                }
            })
            $j('.stockAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    if($j('.stockAutoSelect').val()==""){
                        //$j('.stockAutoSelect').focus();
                    } else {
                        js_get_stock_info($j("input[name='en_stockid']").val());
                    }
                },300);
                return false;
            });
            $j('.stockAutoSelect').on('blur', function (e, datum) {
                $j(this).change();
                return false;
            });
            if($j(".enterseq").filter("[seq='1']").is("input")) {
                $j("input[type='text']").filter("[seq='1']").select();
            } else if($j(".enterseq").filter("[seq='1']").is("select")){
                $j("select").filter("[seq='1']").focus();
            } else if($j(".enterseq").filter("[seq='1']").is("checkbox")){
                $j("checkbox").filter("[seq='1']").select();
            } else if($j(".enterseq").filter("[seq='1']").is("button")){
                $j("button").filter("[seq='1']").focus();
            }
            setTimeout(function(){ if($j(".searchInvNo").length>0){ $j(".searchInvNo").select(); } else { $j('.customerAutoSelect').select(); } }, 100);
            // $j("input[name='salesinvoicedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
            //     $j(this).datepicker('hide');
            // });
            $j("input[name='en_qty']").on("input", function() {
                var v= $j(this).val(), vc = v.replace(/[^0-9]/, '');
                if (v !== vc)
                    $j(this).val(vc);
            });
            /*$j("input[name='en_unitprice']").on("input", function(e) {
                var v= $j(this).val(), vc = v.replace(/[^0-9\.]/, '');
                if (v !== vc)
                    $j(this).val(vc);
            });*/
            $j("input[name='en_discount']").on("input", function() {
                var v= $j(this).val(), vc = v.replace(/[^0-9\.]/, '');
                if (v !== vc)
                    $j(this).val(vc);
            });
            @if(isset($data["editbox"]) && $data["editbox"]=="Y")
            $j("#btnAction").text("Update");
            $j("#salesform").append('<input name="_method" type="hidden" value="PATCH">');
            $j("input[name!='srch_inv_no_text']").attr("readOnly","readOnly");
            $j("select").attr("readOnly","readOnly");
            $j("#btnBack").attr("href","{{ action('SalesInvoiceController@index') }}");
            var invid = "{{ (isset($default['invid']))?$default['invid']:'' }}";
            if(invid!=""){
                js_get_salesinv_info(invid);
            }
            @endif

            @if(isset($data["checkcust"]) && $data["checkcust"]=="Y")
            $j('.srchcustAutoSelect').autoComplete({minLength:2,
                events: {
                    searchPost: function (resultFromServer) {
                        setTimeout(function(){
                            $j('.srchcustAutoSelect').next().find('a').eq(0).addClass("active");
                        },100)
                        return resultFromServer;
                    }
                }
            });
            $j('.srchcustAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j('.srchcustAutoSelect').change();
                    return false;
                }
            })
            $j('.srchcustAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    if($j('.srchcustAutoSelect').val()==""){
                        $j('.srchcustAutoSelect').focus();
                    } else {
                        var ss = $j('.srchcustAutoSelect').val().split("-");
                        $j('.srchcustAutoSelect').val(ss[0]);
                        js_customer_sales($j("input[name='srch_cust']").val());
                    }
                },300);
                return false;
            });
            var slmodal = $j('#doCheckCustModal').modal({
                backdrop: 'static',
                keyboard: true
            });

            setTimeout(function(){ $j(".srchcustAutoSelect").focus(); },1000);

            $j('#doCheckCustModal').on('hidden.bs.modal', function () {
                window.location="{{url('salesinvoice')}}"
            })
            @endif
            @if(isset($data["checkinv"]) && $data["checkinv"]=="Y")
            var slmodal = $j('#doCheckInvModal').modal({
                backdrop: 'static',
                keyboard: true
            });
            //setTimeout(function(){ $j("input[name='invdatfr']").focus(); },1000);
            $j("input[name='invdatfr'],input[name='invdatto']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    js_chksales_list($j("input[name='invdatfr']").val(),$j("input[name='invdatto']").val());
                    return false;
                }
            })
            js_chksales_list($j("input[name='invdatfr']").val(),$j("input[name='invdatto']").val());
            $j('#doCheckInvModal').on('hidden.bs.modal', function () {
                window.location="{{url('salesinvoice')}}"
            })
            @endif

            @can('PRINT SALES INVOICE')
            @can('PRINT SALES DELIVERY ORDER')
            @if(\Session::has('id'))
            @if(\Session::has('printdo') && \Session::get('printdo')=="Y")
            setTimeout(function(){
                //window.open("salesinvoice/invoice/{{\Session::get('id')}}?prtdo=Y");
                //window.open("{{ url('/') }}/pdf/do_{{\Session::get('id')}}.pdf");
                //window.open("{{ url('/') }}/pdf/invoice_{{\Session::get('id')}}.pdf");
                window.open("salesinvoice/invoice/{{\Session::get('id')}}"+"?"+Math.random().toString(36).substring(7));
                window.open("salesinvoice/do/{{\Session::get('id')}}"+"?"+Math.random().toString(36).substring(7));
                $j("#cpinvid").val("{{\Session::get('id')}}");
                //fileName1="http://192.168.42.238/printfile/print.php";
                prtopt="invdo";
                printfile2();
                //printfile("http://192.168.42.238/printfile/print.php","Sales DO",'dono',"{{\Session::get('id')}}");
                //window.open("salesinvoice/lhinvoice/{{\Session::get('id')}}");
                //window.open("salesinvoice/lhdo/{{\Session::get('id')}}");
            }, 1000);
            @else
            setTimeout(function(){
                window.open("salesinvoice/invoice/{{\Session::get('id')}}"+"?"+Math.random().toString(36).substring(7));
                prtopt="inv";
                printfile2();
                //printfile("http://192.168.42.238/printfile/print.php","Sales Invoice",'invno',"{{\Session::get('id')}}");
                //window.open("salesinvoice/lhinvoice/{{\Session::get('id')}}");
            }, 1000);
            @endif
            @endif
            @endcan
            @elsecan('PRINT SALES DELIVERY ORDER')
            @if(\Session::has('id'))
            @if(\Session::has('printdo') && \Session::get('printdo')=="Y")
            setTimeout(function(){
                window.open("salesinvoice/do/{{\Session::get('id')}}"+"?"+Math.random().toString(36).substring(7));
                prtopt="do";
                printfile2();
                //printfile("http://192.168.42.238/printfile/print.php","Sales DO",'dono',"{{\Session::get('id')}}");
                //window.open("salesinvoice/lhdo/{{\Session::get('id')}}");
            }, 1000);
            @endif
            @endif
            @endcan
            @if(\Session::has('printnote') && \Session::get('printnote')=="Y")
            setTimeout(function(){
                window.open("salesinvoice/note/{{\Session::get('id')}}?snl={{\Session::get('salesnotelist')}}"+"?"+Math.random().toString(36).substring(7),"printnote");
            },  1000);
            @endif
            $j("#btdoyes").click(function(evt){
                $j("input[name='printdo']").val('Y');
                $j("#doPrintModal .close").click();
                $j("#salesform").submit();
                return false;
            })
            $j("#btdono").click(function(evt){
                $j("input[name='printdo']").val('N');
                $j("#doPrintModal .close").click();
                $j("#salesform").submit();
                return false;
            })
            $j("#btnSaveSalesNote").click(function(evt){
                bsavenote=true;
                $j("#salesNoteModal .close").click();
                $j("#salesnote").val($j("#salesnote").val().toUpperCase());
                $j("input[name='salesnote']").val($j("#salesnote").val());
                $j("input[name='printnote']").val("N");
                js_ask_do_submit();
                return false;
            })
            $j("#btnSaveSalesNotePrint").click(function(evt){
                bsavenote=true;
                $j("#salesNoteModal .close").click();
                $j("#salesnote").val($j("#salesnote").val().toUpperCase());
                $j("input[name='salesnote']").val($j("#salesnote").val());
                $j("input[name='printnote']").val("Y");
                js_ajax_checknote();
                return false;
            })

            $j("#btnSaveSalesNoteInvPrint").click(function(evt){
                bsavenote=true;
                $j("#salesNoteListModal .close").click();
                var notelist = "";
                $j("input[name='noteinvid[]']").each(function(i){
                    if($j(this).prop("checked") == true){
                        notelist+=(notelist!="")?",":"";
                        notelist+=$j(this).val();
                    }
                })
                $j("input[name='salesnotelist']").val(notelist);
                js_ask_do_submit();
                return false;
            })

            $j("#btnSaveSalesSaveNote").click(function(evt){
                var mnote = $j('#salesSaveNoteModal #salessavenote').val().toUpperCase();
                var invid = $j('#salesSaveNoteModal #salessavenote').attr("invid");
                $j("#salesSaveNoteModal .close").click();
                //var mnote = prompt("Sales Note:",snote);
                //mnote = mnote.toUpperCase();
                if(mnote!="" && mnote!=null){
                    data="invid="+invid;
                    data+="&mnote="+mnote;
                    $j.ajax({
                        url:"{{action('App\Http\Controllers\SalesInvoicesController@savesalesnote')}}",
                        type:'post',
                        dataType: 'json',
                        data:data,
                        success: function(json){
                            alert(json.msg);
                            js_ajax_checknote();
                            return false;
                        }
                    })
                }
                return false;
            })

            $j("#salesform").submit(function(evt){
                $j("input[type='text']").each(function(i){
                    $j(this).val($j(this).val().toUpperCase());
                })
                var spmodal = $j('#submitProcessModal').modal({
                    backdrop: 'static'
                });
                if(!bsavenote){
                    setTimeout(function(){
                        $j("#submitProcessModal .close").click();
                        var modal = $j('#salesNoteModal').modal({
                            backdrop: 'static'
                        });
                        $j('#salesNoteModal #salesnote').val($j("input[name='salesnote']").val());
                        setTimeout(function(){ $j("#salesnote").focus(); },500 );
                    },500);
                    return false;
                } else {
                    if(bsave){
                        return false;
                    }
                    bsave = true;
                }
            })
            // $j("input[name='invdatfr']").datepicker({
            //     autoclose: true,
            //     format: 'dd/mm/yyyy'
            // }).on("change.datetimepicker", function (e) {
            //     js_chksales_list($j("input[name='invdatfr']").val(),$j("input[name='invdatto']").val());
            // }).on('changeDate', function(e){
            //     $j(this).datepicker('hide');
            // });
            // $j("input[name='invdatto']").datepicker({
            //     autoclose: true,
            //     format: 'dd/mm/yyyy'
            // }).on("change.datetimepicker", function (e) {
            //     js_chksales_list($j("input[name='invdatfr']").val(),$j("input[name='invdatto']").val());
            // }).on('changeDate', function(e){
            //     $j(this).datepicker('hide');
            // });
            $j("#inv_cps").keydown(function(evt){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("#do_cps").select();
                    return false;
                }

            })
            $j("#do_cps").keydown(function(evt){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j("#btnPrintDirect").focus();
                    return false;
                } else if (keycode==38){
                    $j("#inv_cps").select();
                    return false;
                }
            })
            $j("#btnPrintDirect").keydown(function(evt){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j(this).click();
                    return false;
                }
            })
            $j("#btnPrintDirect").click(function(evt){
                /*pdata={};
                pdata["invno"]=$j("#cpinvid").val();
                pdata["dono"]=$j("#cpinvid").val();
                pdata["invcp"]=$j("#inv_cps").val();
                pdata["docp"]=$j("#do_cps").val();
                //console.log(pdata);
                //console.log(fileName1);
                //return false;
                $j.post( fileName1,pdata, function( data ) {
                });*/
                pdata={};
                pdata["id"]=$j("#cpinvid").val();
                if(prtopt=="inv"){
                    pdata["invcp"]=$j("#inv_cps").val();
                } else if(prtopt=="do"){
                    pdata["docp"]=$j("#do_cps").val();
                } else {
                    pdata["invcp"]=$j("#inv_cps").val();
                    pdata["docp"]=$j("#do_cps").val();
                }
                $j.ajax({
                    url:"{{action('App\Http\Controllers\SalesInvoicesController@pdftoprinter')}}",
                    type:'post',
                    dataType: 'json',
                    data:pdata,
                    success: function(json){
                        window.location="{{ action('App\Http\Controllers\SalesInvoicesController@index') }}";
                        return false;
                    }
                })
            })
        })
        function printfile2(){
            if(prtopt=="inv"){
                $j("#do_cps").attr("disabled",true);
                $j("#do_cps").parent().hide();
            } else if(prtopt=="do"){
                $j("#inv_cps").attr("disabled",true);
                $j("#inv_cps").parent().hide();
            }
            var modal = $j('#printDirectModal').modal({
                backdrop: 'static'
            });
            setTimeout(function(){
                $j("#inv_cps").select();
            },1000);
            /*$j.get(fileName1)
            .done(function(data) {
                if(data=="file ready!"){

                }
            }).fail(function(data) {
                //console.log("fail->"+fileName1);
            })*/
        }
        function js_ajax_checknote(){
            data="customerid="+$j("input[name='customerid']").val();
            $j.ajax({
                url:"{{action('App\Http\Controllers\SalesInvoicesController@checkcustnote')}}",
                type:'post',
                dataType: 'json',
                data:data,
                success: function(json){
                    if(json.list){
                        var modal = $j('#salesNoteListModal').modal({
                            backdrop: 'static'
                        });
                        var notecheck = "";
                        $j.each(json.list,function(ilp,rwv){
                            notecheck+="<input type='checkbox' name='noteinvid[]' value='"+rwv["id"]+"' checked='checked'><a href='javascript:void(0);' onclick='js_salesnote_input(\""+rwv["id"]+"\",\""+rwv["sales_note"]+"\")'>"+rwv["salesinvoicecode"]+"-"+rwv["sales_note"].substr(0,10)+"</a><br>";
                        })
                        $j('#salesNoteListModal .notecheckbox').html(notecheck);
                    }
                    return false;
                }
            })
        }
        function js_salesnote_input(invid,snote){
            var modal = $j('#salesSaveNoteModal').modal({
                backdrop: 'static'
            });
            $j('#salesSaveNoteModal #salessavenote').val(snote);
            $j('#salesSaveNoteModal #salessavenote').attr("invid",invid);
            setTimeout(function(){ $j("#salessavenote").focus(); },500 );
            return false;
        }
        function js_ask_do_submit(){
            @can('PRINT SALES DELIVERY ORDER')
            if($j("input[name='printdo']").val()==""){
                $j("input[name='printdo']").val('Y');
                $j("#salesform").submit();
                /*var modal = $j('#doPrintModal').modal({
                    backdrop: 'static'
                });*/
            }
            @else
            $j("#salesform").submit();
            @endcan
        }
        function js_stock_click(id){
            $j("#doStocklistModal .close").click();
            $j("input[name='en_stockid']").val(id);
            js_get_stock_info(id);
            return false;
        }
        function js_stock_select(tr){
            $j(tr).parent().find('tr').removeClass('selected');
            $j(tr).addClass('selected');
        }
        function js_chksales_list(datfr,datto){
            data="invdatfr="+datfr;
            data+="&invdatto="+datto;
            $j.ajax({
                url:"{{action('App\Http\Controllers\SalesInvoicesController@checkinv')}}",
                type:'post',
                dataType: 'json',
                data:data,
                success: function(json){
                    $j("#invsalestbl tbody").empty();
                    if( Object.keys(json.saleslist).length>0){
                        var totsal=parseFloat(0);
                        $j.each(json.saleslist,function(i,dt){
                            var newrow = $j('<tr>').attr('onclick','js_tr_click('+dt.id+',this)')
                                .attr('ondblclick','js_tr_dblclick('+dt.id+',this)')
                                .attr('dataid',dt.id )
                                .append($j('<td>').append( dt.date ))
                                .append($j('<td>').append( "<a href='javascript:void(0);' onclick='js_get_inv_pdf(\""+dt.invoiceno+"\")'>"+dt.invoiceno+"</a>" ))
                                .append($j('<td>').append( dt.name ))
                                .append($j('<td>').addClass('text-right').append( dt.sal_amt ));
                            $j("#invsalestbl tbody").append(newrow);
                            totsal=totsal+parseFloat(dt.sal_amt);
                        })
                        $j(".totqty").html(json.saleslist.length);
                        $j(".totamt").html(totsal.toFixed(2));
                        $j("#invsalestbl tbody tr").eq(0).addClass('bg-warning');
                        js_get_salesinv_info($j("#invsalestbl tbody tr.bg-warning").attr("dataid"));
                        $j(document).unbind('keydown');
                        $j(document).keydown(function(event){
                            var keycode = (event.keyCode ? event.keyCode : event.which);
                            if(keycode==38){
                                var idx = $j("#invsalestbl tbody tr").index($j("#invsalestbl tbody tr.bg-warning"));
                                if(idx>0){
                                    idx=idx-1;
                                    $j("#invsalestbl tbody tr.bg-warning").removeClass('bg-warning');
                                    $j("#invsalestbl tbody tr").eq(idx).addClass('bg-warning');
                                    var rowpos = $j('#invsalestbl tbody tr.bg-warning').position();
                                    $j('#doCheckInvModal .form-group').scrollTop(rowpos.top-50);
                                    js_get_salesinv_info($j("#invsalestbl tbody tr.bg-warning").attr("dataid"));
                                }
                                return false;
                            } else if(keycode==40){
                                var idx = $j("#invsalestbl tbody tr").index($j("#invsalestbl tbody tr.bg-warning"))+1;
                                if(idx<$j("#invsalestbl tbody tr").length){
                                    $j("#invsalestbl tbody tr.bg-warning").removeClass('bg-warning');
                                    $j("#invsalestbl tbody tr").eq(idx).addClass('bg-warning');
                                    var rowpos = $j('#invsalestbl tbody tr.bg-warning').position();
                                    $j('#doCheckInvModal .form-group').scrollTop(rowpos.top-50);
                                    js_get_salesinv_info($j("#invsalestbl tbody tr.bg-warning").attr("dataid"));
                                }
                                return false;
                            }
                        })
                    } else {
                        var newrow = $j('<tr>')
                            .append($j('<td colspan="4">').addClass("text-center").append( "No Records" ));
                        $j("#invsalestbl tbody").append(newrow);
                    }
                    return false;
                }
            })
        }
        function js_get_inv_pdf(invno){
            window.open("{{url('salesinvoice')}}/lhinvoice/"+invno+"?"+Math.random().toString(36).substring(7));
            window.open("{{url('salesinvoice')}}/lhdo/"+invno+"?"+Math.random().toString(36).substring(7));
        }
        function js_customer_sales(customerid){
            data="customerid="+customerid;
            $j.ajax({
                url:"{{action('App\Http\Controllers\SalesInvoicesController@checkcust')}}",
                type:'post',
                dataType: 'json',
                data:data,
                success: function(json){
                    $j("#custsalestbl tbody").empty();
                    if( Object.keys(json.saleslist).length>0){
                        var totalostd=parseFloat(0);
                        $j.each(json.saleslist,function(i,dt){
                            var newrow = $j('<tr>').attr('onclick','js_tr_click('+dt.id+',this)')
                                .attr('ondblclick','js_tr_dblclick('+dt.id+',this)')
                                .attr('dataid',dt.id )
                                .append($j('<td>').append( dt.date ))
                                .append($j('<td>').append( "<a href='javascript:void(0);' onclick='js_get_inv_pdf(\""+dt.invoiceno+"\")'>"+dt.invoiceno+"</a>" ))
                                .append($j('<td>').addClass('text-right').append( dt.sal_amt ))
                                .append($j('<td>').addClass('text-right').append( dt.out_amt ))
                                .append($j('<td>').addClass('text-right').append( dt.last_paid ));
                            $j("#custsalestbl tbody").append(newrow);
                            totalostd+=parseFloat(dt.out_amt);
                        })
                        $j(".totostd").html(totalostd.toFixed(2));
                        $j("#custsalestbl tbody tr").eq(0).addClass('bg-warning');
                        js_get_salesinv_info($j("#custsalestbl tbody tr.bg-warning").attr("dataid"));
                        $j(document).unbind('keydown');
                        $j(document).keydown(function(event){
                            var keycode = (event.keyCode ? event.keyCode : event.which);
                            if(keycode==38){
                                var idx = $j("#custsalestbl tbody tr").index($j("#custsalestbl tbody tr.bg-warning"));
                                if(idx>0){
                                    idx=idx-1;
                                    $j("#custsalestbl tbody tr.bg-warning").removeClass('bg-warning');
                                    $j("#custsalestbl tbody tr").eq(idx).addClass('bg-warning');
                                    var rowpos = $j('#custsalestbl tbody tr.bg-warning').position();
                                    $j('#doCheckCustModal .form-group').scrollTop(rowpos.top-50);
                                    js_get_salesinv_info($j("#custsalestbl tbody tr.bg-warning").attr("dataid"));
                                }
                                return false;
                            } else if(keycode==40){
                                var idx = $j("#custsalestbl tbody tr").index($j("#custsalestbl tbody tr.bg-warning"))+1;
                                if(idx<$j("#custsalestbl tbody tr").length){
                                    $j("#custsalestbl tbody tr.bg-warning").removeClass('bg-warning');
                                    $j("#custsalestbl tbody tr").eq(idx).addClass('bg-warning');
                                    var rowpos = $j('#custsalestbl tbody tr.bg-warning').position();
                                    $j('#doCheckCustModal .form-group').scrollTop(rowpos.top-50);
                                    js_get_salesinv_info($j("#custsalestbl tbody tr.bg-warning").attr("dataid"));
                                }
                                return false;
                            }
                            //setTimeout(function(){ $j(".srchcustAutoSelect").focus(); },1000);
                        })
                    } else {
                        var newrow = $j('<tr>')
                            .append($j('<td colspan="5">').addClass("text-center").append( "No Records" ));
                        $j("#custsalestbl tbody").append(newrow);
                    }
                    return false;
                }
            })
        }
        function js_tr_click(invid,tr){
            var tbl = $j(tr).closest('table');
            var idx = $j(tbl).find("tbody tr").index($j(tr));
            $j(tbl).find("tbody tr.bg-warning").removeClass('bg-warning');
            $j(tbl).find("tbody tr").eq(idx).addClass('bg-warning');
            var rowpos = $j(tbl).find('tbody tr.bg-warning').position();
            $j('#doCheckCustModal .form-group').scrollTop(rowpos.top-50);
            js_get_salesinv_info(invid);
            return false;
        }
        function js_tr_dblclick(invid,tr){
            window.location = "{{ action('App\Http\Controllers\ServiceRatesController@edit',1) }}?invid="+invid;
            return false;
        }
        function js_search_customer_info(customerid,jscallback){
            data="customerid="+customerid;
            {{--$j.ajax({--}}
            {{--    //url:"{{ action('App\Http\Controllers\SalesInvoicesController@getcustinfo') }}",--}}
            {{--    url:"{{ action('/') }}",--}}
            {{--    type:'post',--}}
            {{--    dataType: 'json',--}}
            {{--    data:data,--}}
            {{--    success: function(json){--}}
            {{--        if(typeof(jscallback)==="function"){--}}
            {{--            jscallback(json);--}}
            {{--        }--}}
            {{--        return false;--}}
            {{--    }--}}
            {{--})--}}
        }
        function js_customer_callback(json){
            $j('input[name="attention"]').val(json.contactperson);
            $j('input[name="phoneno1"]').val(json.phoneno1);
            $j('select[name="termid"]').val(json.termid);
            $j('input[name="customername"]').val(json.customername);
            $j("input[type='text']").filter("[seq='2']").select();
        }
        function js_get_stock_info(stockid){
            /*if($j(".editnum").html()!=""){
              var num=$j(".editnum").html();
              if($j("input[name='stockid[]']").eq((num-1)).val()==stockid){
                $j("input[name='en_description']").select();
                $j(".stockAutoSelect").val($j("input[name='stockid[]']").eq((num-1)).next().html());
                $j("input[name='en_stockid']").val($j("input[name='stockid[]']").eq((num-1)).val());
                return false;
              }
            }*/
            data="stockid="+stockid+"&custid="+$j("input[name='customerid']").val();
            {{--$j.ajax({--}}
            {{--    url:"{{action('SalesInvoiceController@getstockinfo')}}",--}}
            {{--    type:'post',--}}
            {{--    dataType: 'json',--}}
            {{--    data:data,--}}
            {{--    success: function(json){--}}
            {{--        var num=$j(".editnum").html();--}}
            {{--        if($j(".editnum").html()!="" && $j("input[name='stockid[]']").eq((num-1)).val()==stockid){--}}
            {{--            $j("select[name='en_uomid']").find('option').remove();--}}
            {{--            $j.each(json.uomid,function(id,dt){--}}
            {{--                var selecteditem = (dt.id==uomsid)?"selected":"";--}}
            {{--                $j("select[name='en_uomid']").append('<option value="'+dt.id+'" '+selecteditem+'>'+dt.uomcode+'</option>');--}}
            {{--            });--}}
            {{--        } else {--}}
            {{--            $j("input[name='en_unitprice']").val(json.sellingprice);--}}
            {{--            $j("input[name='en_description']").val(json.stockname);--}}
            {{--            $j("input[name='en_note']").val(json.stockspec);--}}
            {{--            $j("input[name='en_discount']").val("0.00");--}}
            {{--            $j("input[name='en_description']").select();--}}
            {{--            $j(".stockAutoSelect").val(json.stockcode);--}}
            {{--            $j("input[name='en_stockid']").val(json.id);--}}
            {{--            $j("select[name='en_uomid']").find('option').remove();--}}
            {{--            $j.each(json.uomid,function(id,dt){--}}
            {{--                // console.log(dt.id+"=="+uomsid);--}}
            {{--                var selecteditem = (dt.id==uomsid)?"selected":"";--}}
            {{--                $j("select[name='en_uomid']").append('<option value="'+dt.id+'" '+selecteditem+'>'+dt.uomcode+'</option>');--}}
            {{--            });--}}
            {{--        }--}}
            {{--        return false;--}}
            {{--    }--}}
            {{--})getinvinfo--}}
            return false;
        }
        function js_calc_netamt(){
            var unitprice = (!isNaN(parseFloat($j("input[name='en_unitprice']").val())))?parseFloat($j("input[name='en_unitprice']").val()):parseFloat(0);
            var qty = (!isNaN(parseFloat($j("input[name='en_qty']").val())))?parseFloat($j("input[name='en_qty']").val()):parseFloat(0);
            var discount = (!isNaN(parseFloat($j("input[name='en_discount']").val())))?parseFloat($j("input[name='en_discount']").val()):parseFloat(0);
            var netamount = parseFloat((unitprice*qty)-discount);
            $j("input[name='en_discount']").val(discount.toFixed(2));
            $j("input[name='en_unitprice']").val(unitprice.toFixed(2));
            $j("input[name='en_amount']").val(netamount.toFixed(2));
            $j("input[name='en_netamount']").val(netamount.toFixed(2));
        }
        function js_add_item(){
            if($j("input[name='description']").val()!="" && $j("input[name='rate']").val()>0){
                var editnum = $j(".editnum").html().trim();
                if(isNaN(parseInt(editnum,10))) {
                    var nseq = $j("input[name='stockid[]']").length+1;
                    var newrow = $j('<tr>').addClass("row")
                        .append($j('<td>').attr("scope","col").append(nseq))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","detid[]").attr("type","hidden").val($j("input[name='en_detid']").val())).append($j("<input>").attr("name","stockid[]").attr("type","hidden").val($j("input[name='en_stockid']").val())).append( $j("<span>").append($j(".stockAutoSelect").val()) ))
                        .append($j('<td>').addClass("col-sm-2").append($j("<input>").attr("name","d_description[]").attr("type","hidden").val($j("input[name='description']").val())).append( $j("<span>").append($j("input[name='description']").val())))
                        .append($j('<td>').addClass("col-sm-2").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append($j("input[name='rate']").val())))
                        .append($j('<td>').addClass("col").append($j("<a>").addClass("btn btn-warning btn-xs fas fa-trash").attr("href","javascript:js_delitem('"+nseq+"');void(0);").text("")));
                    $j("#bodyitem").append(newrow);
                } else {
                    $j("input[name='detid[]']").eq((editnum-1)).val($j("input[name='en_detid']").val());
                    $j("input[name='d_description[]']").eq((editnum-1)).val($j("input[name='description']").val());
                    $j("input[name='d_rate[]']").eq((editnum-1)).val($j("input[name='rate']").val());
                }
                js_itemlist_refresh();
            } else {
                alert("Description and rate/trip is compulsory data!")
                $j(".stockAutoSelect").select();
            }
            return false;
        }
        function js_calc_total(){
            var qty=0, disc=0, amt=0, netamt=0;
            $j("input[name='qty[]']").each(function(i){
                qty=qty+((!isNaN(parseInt($j(this).val(),10)))?parseInt($j(this).val(),10):0);
                disc=disc+((!isNaN(parseFloat($j("input[name='discount[]']").eq(i).val())))?parseFloat($j("input[name='discount[]']").eq(i).val()):0);
                amt=amt+((!isNaN(parseFloat($j("input[name='amount[]']").eq(i).val())))?parseFloat($j("input[name='amount[]']").eq(i).val()):0);
                netamt=netamt+((!isNaN(parseFloat($j("input[name='netamount[]']").eq(i).val())))?parseFloat($j("input[name='netamount[]']").eq(i).val()):0);
            })
            $j(".totalqty").html(qty);
            $j(".totaldiscount").html(parseFloat(disc).toFixed(2));
            $j(".totalamount").html(parseFloat(amt).toFixed(2));
            $j(".totalnetamount").html(parseFloat(netamt).toFixed(2));
            return false;
        }
        function js_delitem(num){
            $j("#bodyitem").find("tr").eq((num-1)).remove();
            $j("#bodyitem tr").each(function(i){
                $j(this).find("td").eq(0).html((i+1));
                $j(this).find("a").eq(0).attr("href","javascript:js_edititem('"+(i+1)+"');void(0);");
                $j(this).find("a").eq(1).attr("href","javascript:js_delitem('"+(i+1)+"');void(0);");
            })
            js_calc_total();
        }
        function js_edititem(num){
            $j(".editnum").html(num);
            $j("input[name='en_detid']").val($j("input[name='detid[]']").eq((num-1)).val());
            $j("input[name='en_stockid']").val($j("input[name='stockid[]']").eq((num-1)).val());
            $j(".stockAutoSelect").val($j("#bodyitem").find("tr").eq((num-1)).find("td").eq(1).find("span").html());
            $j("input[name='en_description']").val($j("input[name='stockname[]']").eq((num-1)).val());
            $j("input[name='en_note']").val($j("input[name='note[]']").eq((num-1)).val());
            $j("input[name='en_qty']").val($j("input[name='qty[]']").eq((num-1)).val());
            $j("input[name='en_unitprice']").val($j("input[name='unitprice[]']").eq((num-1)).val());
            $j("input[name='en_discount']").val($j("input[name='discount[]']").eq((num-1)).val());
            $j("input[name='en_amount']").val($j("input[name='amount[]']").eq((num-1)).val());
            $j("input[name='en_netamount']").val($j("input[name='netamount[]']").eq((num-1)).val());
            $j("select[name='en_uomid']").val($j("input[name='uomsid[]']").eq((num-1)).val());
            $j(".canceledit").html('<a href="javascript:js_add_item(); $j(\'.stockAutoSelect\').select(); void(0);" class="btn btn-success fas fa-check-circle"></a><a href="javascript:js_itemlist_refresh(); $j(\'.stockAutoSelect\').select(); void(0);" class="btn btn-danger fas fa-times-circle"></a> ');
            //console.log($j("input[name='uomsid[]']").eq((num-1)).val());
            uomsid = $j("input[name='uomsid[]']").eq((num-1)).val();
            //js_get_stock_info($j("input[name='en_stockid']").val());

            //$j(".stockAutoSelect").select();
            return false;
        }
        function js_itemlist_refresh(){
            $j(".editnum").html(" &nbsp;&nbsp;");
            $j(".dropdown-menu").empty();
            $j(".stockAutoSelect").val('');
            $j("input[name='en_detid']").val('');
            $j("input[name='en_stockid']").val('');
            $j("input[name='en_description']").val('');
            $j("input[name='en_note']").val('');
            $j("input[name='en_qty']").val('');
            $j("select[name='en_uomid']").find('option').remove();
            $j("select[name='en_uomid']").append('<option value=""> -- Selection -- </option>');
            $j("input[name='en_unitprice']").val('');
            $j("input[name='en_discount']").val('');
            $j("input[name='en_amount']").val('');
            $j("input[name='en_netamount']").val('');
            $j(".canceledit").empty();
            js_calc_total();
            return false;
        }
        function js_get_salesinv_info(salesid,salescode){
            $j("#bodyitem").empty();
            $j("input").empty();
            data="salescod="+salescode;
            data+="&salesinvid="+salesid;
            {{--$j.ajax({--}}
            {{--    url:"{{action('SalesInvoiceController@getinvinfo')}}",--}}
            {{--    type:'post',--}}
            {{--    dataType: 'json',--}}
            {{--    data:data,--}}
            {{--    success: function(json){--}}
            {{--        $j("input").each(function(i){--}}
            {{--            if(json.mast[$j(this).attr("name")]!=undefined){--}}
            {{--                $j(this).val(json.mast[$j(this).attr("name")]);--}}
            {{--            }--}}
            {{--        })--}}
            {{--        $j("select").each(function(i){--}}
            {{--            if(json.mast[$j(this).attr("name")]!=undefined){--}}
            {{--                $j(this).val(json.mast[$j(this).attr("name")]);--}}
            {{--            }--}}
            {{--        })--}}
            {{--        if(json.det!=undefined && Object.keys(json.det).length>0){--}}
            {{--            $j.each(json.det,function(idx,dat){--}}
            {{--                $j("select[name='en_uomid']").find('option').remove();--}}
            {{--                $j("select[name='en_uomid']").append('<option value="'+dat.uomid+'">'+dat.uomcode+'</option>');--}}
            {{--                $j("input[name^='en_']").each(function(i){--}}
            {{--                    if(dat[$j(this).attr("name").substr(3)]!=undefined){--}}
            {{--                        $j(this).val(dat[$j(this).attr("name").substr(3)]);--}}
            {{--                    }--}}
            {{--                })--}}
            {{--                js_add_item();--}}
            {{--            })--}}
            {{--        }--}}
            {{--        $j(".dropdown-menu").empty();--}}
            {{--        $j("#salesform").attr("action","{{action('SalesInvoiceController@update', "")}}/"+json.mast["id"]);--}}

            {{--        $j("input[class!='readonly']").attr("readOnly",false);--}}
            {{--        $j("select").attr("readOnly",false);--}}
            {{--    }--}}
            {{--})--}}
        }
    </script>
@endsection

@section('topbar')

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

    </form>

@endsection


