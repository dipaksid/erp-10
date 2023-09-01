@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">System Setting</h1>
            </div>
            @include('partials/messages')
            @if(isset($systemSettings) && $systemSettings->count())
                <form id="settingform" method="post" action="{{ url('system_settings', ['systemSetting' => $systemSettings]) }}" >
                    @method('PUT')
            @else
                <form id="settingform" method="post" action="{{ url('system_settings') }}" >
            @endif
                @csrf
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#general">General Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#job">Job Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#sms">SMS Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#gst">GST Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stock">Stock Setting</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    @include('system_settings/general')
                    @include('system_settings/job')
                    @include('system_settings/sms')
                    @include('system_settings/gst')
                    @include('system_settings/stock')
                </div>
                <button type="submit" seq="23" class="btn btn-primary enterseq">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        if ($("#settingform").length > 0) {
            $("#settingform").validate({
                rules: {
                    jobrefreshtime: {
                        required: true,

                    },
                    jobnotifyday: {
                        required: true,

                    },
                    emailsender: {
                        email: true,
                        maxlength:100
                    },
                    invoiceprinter: {
                        maxlength:100
                    },
                    poprinter: {
                        maxlength:100
                    },
                    receiptprinter: {
                        maxlength:100
                    },
                    paymentprinter: {
                        maxlength:100
                    },
                    creditnoteprinter: {
                        maxlength:100
                    },
                    reportprinter: {
                        maxlength:100
                    },
                    stickerprinter: {
                        maxlength:100
                    }
                },
                messages: {
                    jobrefreshtime: {
                        required: "Please enter seconds.",

                    },
                    jobnotifyday: {
                        required: "Please enter days."
                    },
                    emailsender: {
                        email: "Invalid email format.",
                        maxlength: "The description should be 100 characters long."
                    },
                    invoiceprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    },
                    poprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    },
                    receiptprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    },
                    paymentprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    },
                    creditnoteprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    },
                    reportprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    },
                    stickerprinter: {
                        maxlength: "Invoice Printer should be 100 characters long."
                    }
                },
            })
            $("#settingform").submit(function(evt){
                $("input[type='text']").each(function(i){
                    if($(this).attr("name")!="sms_username" && $(this).attr("name")!="sms_password"){
                        $(this).val($(this).val().toUpperCase());
                    }
                })
            })
        }
        function chk(e){
            alert($(e).val().keyCode);
        }
        function isValidDate(d) {
            return d instanceof Date && !isNaN(d);
        }
        function js_dateformat(input){
            if($(input).val().length==8){
                let date = new Date($(input).val().substr(4,4), ($(input).val().substr(2,2)-1), $(input).val().substr(0,2));
                if(isValidDate(date)){
                    var dd = date.getDate();
                    var mm = date.getMonth()+1;
                    var yyyy = date.getFullYear();
                    if(dd<10) {
                        dd='0'+dd;
                    }
                    if(mm<10) {
                        mm='0'+mm;
                    }
                    $(input).val(dd+"/"+mm+"/"+yyyy);
                } else {
                    $(input).val("");
                    $(input).select();
                }
            } else if($(input).val().length==10){
                let date = new Date($(input).val().substr(6,4), ($(input).val().substr(3,2)-1), $(input).val().substr(0,2));
                if(!isValidDate(date)){
                    $(input).val("");
                    $(input).select();
                }
            } else {
                $(input).val("");
                $(input).focus();
            }
        }
        $(document).ready(function(evt){
            $(".enterseq").each(function(i){
                $(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($(this).is("input")) {
                                $(this).val($(this).val().toUpperCase());
                                if($(this).is("input[id='effectivedate_from']")){
                                    js_dateformat(this);
                                }
                                if($(this).is("input[id='effectivedate_to']")){
                                    js_dateformat(this);
                                }
                                if($(this).attr("name")=="rate"){
                                    var getrate = document.getElementById("rate").value;

                                    if(parseFloat(getrate)>99.99){
                                        alert("Rate cannot be more than 99.99%");
                                    } else {
                                        js_add_item();
                                    }
                                    //js_add_item();
                                    //  $(".stockAutoSelect").select();
                                }
                            } else if($(this).is("button[type='submit']")) {
                                $(this).click();
                                return false;
                            }
                            var dd = parseInt($(this).attr("seq"),10)+1;
                            if( $(".enterseq").filter("[seq='"+dd+"']").length>0){
                                if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='text']")) {
                                    $("input[type='text']").filter("[seq='"+dd+"']").select();
                                } if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='number']")) {
                                    $("input[type='number']").filter("[seq='"+dd+"']").select();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $("select").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='date']")){
                                    $("input[type='date']").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            return false;
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

                    if($(this).attr("name")=="effectivedate_to"){
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
        function js_click(obj){
            if($(obj).prop("checked")){
                $(obj).parent().find("input[type='hidden']").val("Y");
            } else {
                $(obj).parent().find("input[type='hidden']").val("N");
            }
        }
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
        function js_add_item(){
            if($("input[name='effectivedate_from']").val()!="" && $("input[name='rate']").val()>0){
                var editnum = $(".editnum").html().trim();
                var r = $("input[name='rate']").val();
                var get_rate = parseInt(r).toFixed(2);

                var nseq = $("input[name='stockid[]']").length+1;

                var newrow = $('<tr>').addClass("row").attr("id","inputFormRow")
                    .append($('<td>').addClass("col-sm-3").append($("<input onkeydown='if (event.keyCode == 13)js_dateformat(this)'>").attr("name","d_effectivedate_from[]").attr("class",'form-control enterseq').attr("type","text").val($("input[name='effectivedate_from']").val())))
                    .append($('<td>').addClass("col-sm-3").append($("<input onkeydown='if (event.keyCode == 13)js_dateformat(this)'>").attr("name","d_effectivedate_to[]").attr("class",'form-control enterseq').attr("type","text").val($("input[name='effectivedate_to']").val())))
                    .append($('<td>').addClass("col-sm-3").append($("<input>").attr("name","d_rate[]").attr("class",'form-control enterseq').attr("type","text").val(get_rate)))
                    .append($('<td>').addClass("col").append($("<button>").addClass("btn btn-warning btn-xs fas fa-trash").attr("type","button").attr("id","removeRow").text("")));
                $("#bodyitem").append(newrow);
                document.getElementById("effectivedate_to").value="";
                document.getElementById("effectivedate_from").value="";
                document.getElementById("rate").value="";
                $("input[type='text']").filter("[seq='18']").select();
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
                            if($(this).attr("name")=="en_qty" || $(this).attr("name")=="en_unitprice" || $(this).attr("name")=="en_discount"){
                                if($(this).attr("name")=="en_qty" && $(this).val()<=0){
                                    $(this).select();
                                    return false;
                                }

                            }
                            if($(this).attr("name")=="rate"){

                                //  $(".stockAutoSelect").select();
                            }
                            return false;
                        }
                        if(keycode==38){

                        }
                    })
                })
            } else {
                alert("Effective date from and rate is compulsory data!")
                $(".stockAutoSelect").select();
            }
            return false;
        }
    </script>
@endsection
