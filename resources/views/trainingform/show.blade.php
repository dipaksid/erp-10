@extends('layouts.app')

@section('styles')
    <style type="text/css">
        .dropdown-menu {
            /*width: 800px !important;*//* you can set by percentage too */
        }
        .datepicker {
            width: auto !important;
        }
        #doStocklistModal .form-group {
            height: 400px;
            overflow: scroll;
        }
        #doStocklistModal .selected {
            background-color: #ddd;
        }
        #doCheckCustModal .modal-dialog, #doCheckInvModal .modal-dialog {
            position: fixed;
            top: 0;
            right: 10px;
            z-index: 10040;
            overflow: auto;
            overflow-y: auto;
        }
        #doCheckCustModal .form-group, #doCheckInvModal .form-group {
            height: 200px;
            overflow: auto;
            width: 600px;
        }
        .modal-backdrop.show {
            opacity: 0.05;
        }
        .modal-open {
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="container">
        <!-- Page Heading Start-->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Training Form</h1>
        </div>
        <!-- Page Heading End-->

        @include('partials/messages')

        <form id="addtrainingform" method="post" action="{{url('trainingform')}}">
            @csrf

            <input type="hidden" name="printdo">
            <input type="hidden" name="salesnote">
            <input type="hidden" name="printnote">
            <input type="hidden" name="salesnotelist">

            <div class="row form-group">
                <div class="col-6">
                    <label for="title">System:</label>
                    <select class="form-control enterseq" readonly seq="1" name="systemcod" id="systemcod">
                        <option value=""> -- Selection --</option>
                        @foreach($data['customercategory'] as $ckey => $rowcat)
                            <option
                                {{(($trainingform->systemcod == $rowcat['categorycode'])?"selected":"")}} value="{{$rowcat['categorycode']}}">{{$rowcat['categorycode']}}
                                - {{$rowcat['description']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control enterseq" readonly seq="2" name="form_title"
                           value="{{$trainingform->form_title}}" id="form_title">

                </div>
            </div>
            <table class="table">
                <thead class="thead-light">
                <tr class="row">
                    <th class="col-sm-1">NO</th>
                    <th class="col-sm-7">Particular</th>
                </tr>
                </thead>
                <tbody id="bodyitem">
                @foreach($trainingdetail as $trainingkey => $rowdetail)
                    @php
                        if($rowdetail->space_lvl == 1){
                          $space_flag = 1;

                        } else {
                          $space_flag = 0;

                        }
                    @endphp
                    <tr class="row">
                        <td class="col-sm-1">{{$rowdetail->no}}</td>
                        @if($rowdetail->special == 1)
                            @if($space_flag == 1)
                                <td class="col-sm-7"><span
                                        style="color:red; margin-left:80px;">{{$rowdetail->particular}}</span></td>
                            @else
                                <td class="col-sm-7"><span style="color:red;">{{$rowdetail->particular}}</span></td>
                            @endif

                        @else
                            @if($space_flag == 1)
                                <td class="col-sm-7"><span style="margin-left:80px;">{{$rowdetail->particular}}</span>
                                </td>
                            @else
                                <td class="col-sm-7">{{$rowdetail->particular}}</td>
                            @endif
                        @endif

                    </tr>

                    @if($detailextra)
                        @foreach($detailextra as $dkey => $extra)
                            @if($extra->detail_id == $rowdetail->id)
                                @php
                                    if($extra->space_lvl == 1){
                                      $space_extra_flag = 1;
                                    } else {
                                      $space_extra_flag = 0;
                                    }
                                @endphp
                                <tr class="row">
                                    <td class="col-sm-1"></td>

                                    @if($extra->special == 1)
                                        @if($space_extra_flag == 1)
                                            <td class="col-sm-7"><span
                                                    style="color:red; margin-left:80px;">{{$extra->particular}}</span>
                                            </td>
                                        @else
                                            <td class="col-sm-7"><span style="color:red; ">{{$extra->particular}}</span>
                                            </td>
                                        @endif
                                    @else
                                        @if($space_extra_flag == 1)
                                            <td class="col-sm-7"><span
                                                    style="margin-left:80px;">{{$extra->particular}}</span></td>
                                        @else
                                            <td class="col-sm-7">{{$extra->particular}}</td>
                                        @endif

                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>

            </table>
            <a href="{{ action('App\Http\Controllers\TrainingFormsController@index') }}" class="btn btn-secondary btn-xs"
               id="btnBack">Back</a>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="noteModalLabel">Full Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
              <textarea class="form-control" name="modal_note" id="modal_note" rows="20" cols="100">
              </textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSaveNote">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="particularDetailModal" tabindex="-1" role="dialog"
             aria-labelledby="particularDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="particularDetailModal">Add Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <div class="row pb-1">
                            <div class="col-6 row">
                                <input type="hidden" class="form-control col-10" name="seq_field2" id="seq_field2"
                                       value="0">
                                <input type="hidden" class="form-control col-10" name="title_id" id="title_id" value="">

                            </div>
                        </div>
                        <div class="form-group">
                            <table id="servicesalestbl" class="table table-striped">
                                <thead class="thead-light">
                                <tr class="row">
                                    <th scope="col" class="editnum2 col-sm-1">&nbsp;</th>

                                    <th class="col-sm-6"><input type='text' name='description_detail'
                                                                id="description_detail" seq="101"
                                                                class="form-control enterseq"></th>
                                    <th class="col-sm-2">
                                        <div class="custom-control custom-switch">

                                            <input type="checkbox" class="custom-control-input enterseq" seq="102"
                                                   id="specialfield_detail" name="specialfield_detail">
                                            <label class="custom-control-label" for="specialfield_detail">Red
                                                color</label>
                                        </div>
                                    </th>
                                    <th>&nbsp;</th>
                                </tr>
                                <tr class="row">
                                    <th class="col-sm-1"></th>
                                    <th class="col-sm-6">Particular</th>
                                    <th class="col-sm-2"></th>

                                    <th class="col">Action</th>
                                </tr>
                                </thead>
                                <tbody id="detailbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button data-dismiss="modal" class="btn btn-secondary btn-xs" id="btnBack">Cancel
                                </button>
                                <button class="btn btn-primary" id="btnAddDetail">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/base.js') }}"></script>
    <script type="text/javascript">
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
        var bsavenote = false;
        var bsave = false;
        var fileName1 = "";
        var searchtrigger = false;
        var ck;
        var uomsid = "";
        var prtopt = "";
        $j(document).ready(function (evt) {
            $j(".enterseq").each(function (i) {
                $j(this).keydown(function (event) {
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch (keycode) {
                        case 13:
                            if ($j(this).is("input")) {
                                $j(this).val($j(this).val().toUpperCase());

                            } else if ($j(this).is("button[type='submit']")) {
                                $j(this).click();
                                return false;
                            }
                            var dd = parseInt($j(this).attr("seq"), 10) + 1;
                            if ($j(".enterseq").filter("[seq='" + dd + "']").length > 0) {
                                if ($j(".enterseq").filter("[seq='" + dd + "']").is("input[type='text']")) {
                                    $j("input[type='text']").filter("[seq='" + dd + "']").select();
                                }
                                if ($j(".enterseq").filter("[seq='" + dd + "']").is("input[type='checkbox']")) {
                                    $j("input[type='checkbox']").filter("[seq='" + dd + "']").focus();
                                } else if ($j(".enterseq").filter("[seq='" + dd + "']").is("select")) {
                                    $j("select").filter("[seq='" + dd + "']").focus();
                                } else if ($j(".enterseq").filter("[seq='" + dd + "']").is("input[type='date']")) {
                                    $j("input[type='date']").filter("[seq='" + dd + "']").focus();
                                } else if ($j(".enterseq").filter("[seq='" + dd + "']").is("button")) {
                                    $j("button").filter("[seq='" + dd + "']").focus();
                                }
                            }
                            if ($j(this).attr("name") == "effectivedate") {
                                $j(".dropdown-menu").remove();
                                if ($j(this).val().length == 8) {

                                    let date = new Date($j(this).val().substr(4, 4), ($j(this).val().substr(2, 2) - 1), $j(this).val().substr(0, 2));
                                    var dd = date.getDate();
                                    var mm = date.getMonth() + 1;
                                    var yyyy = date.getFullYear();
                                    if (dd < 10) {
                                        dd = '0' + dd;
                                    }
                                    if (mm < 10) {
                                        mm = '0' + mm;
                                    }
                                    $j(this).val(dd + "/" + mm + "/" + yyyy);

                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($j(this).attr("seq"), 10) > 0) ? (parseInt($j(this).attr("seq"), 10) - 1) : parseInt($j(this).attr("seq"), 10);
                            if ($j("input[type='text']").filter("[seq='" + dd + "']").length > 0) {
                                $j("input[type='text']").filter("[seq='" + dd + "']").select();
                                ;
                            } else if ($j("input[type='date']").filter("[seq='" + dd + "']").length > 0) {
                                $j("input[type='date']").filter("[seq='" + dd + "']").select();
                                ;
                            } else if ($j("select").filter("[seq='" + dd + "']").length > 0) {
                                $j("select").filter("[seq='" + dd + "']").focus();
                                ;
                            }
                            break;
                    }

                    if (keycode == 13) {


                        if ($j(this).attr("name") == "en_qty" || $j(this).attr("name") == "en_unitprice" || $j(this).attr("name") == "en_discount") {
                            if ($j(this).attr("name") == "en_qty" && $j(this).val() <= 0) {
                                $j(this).select();
                                return false;
                            }

                        }
                        if ($j(this).attr("name") == "specialfield_detail") {
                            js_add_item2();
                        }
                        if ($j(this).attr("name") == "specialfield") {
                            js_add_item();
                            //  $j(".stockAutoSelect").select();
                        }
                        return false;
                    }
                    if (keycode == 38) {
                        if ($j(this).attr("name") == "attention") {
                            $j(".customerAutoSelect").select();
                        }
                        if ($j(this).attr("name") == "en_description") {
                            $j(".stockAutoSelect").select();
                        }
                    }
                })
            })
            // $j("input[name='effectivedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function (e) {
            //     $j(this).datepicker('hide');
            // });


            $j("input[name='effectivedate']").keydown(function (event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                switch (keycode) {
                    case 13:
                        $j("#btnAction").focus();
                        return false;
                        break;
                }
            })
            ck = CKEDITOR.replace('modal_note');
            ck.on('key', function (event) {
                var keycode = (event.data.keyCode ? event.data.keyCode : event.data.which);
                if (keycode == 27) {
                    $j("#noteModal .close").click();
                    return false;
                } else if (keycode == 113) {
                    $j("#noteModal #btnSaveNote").focus();
                    return false;
                }
            })
            $j("input[name='en_note']").focus(function (evt) {
                var modal = $j('#noteModal').modal({
                    backdrop: 'static',
                    keyboard: true
                });
                setTimeout(function () {
                    ck.focus();
                    if ($j("input[name='en_note']").val() != "") {
                        ck.setData($j("input[name='en_note']").val());
                    } else {
                        ck.setData(" &nbsp; ");
                    }
                }, 1000);
                $j("#btnSaveNote").unbind('click');
                $j("#btnSaveNote").click(function (evt) {
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

            if ($j(".enterseq").filter("[seq='1']").is("input")) {
                $j("input[type='text']").filter("[seq='1']").select();
            } else if ($j(".enterseq").filter("[seq='1']").is("select")) {
                $j("select").filter("[seq='1']").focus();
            } else if ($j(".enterseq").filter("[seq='1']").is("checkbox")) {
                $j("checkbox").filter("[seq='1']").select();
            } else if ($j(".enterseq").filter("[seq='1']").is("button")) {
                $j("button").filter("[seq='1']").focus();
            }
            setTimeout(function () {
                if ($j(".searchInvNo").length > 0) {
                    $j(".searchInvNo").select();
                } else {
                    $j('.customerAutoSelect').select();
                }
            }, 100);
            // $j("input[name='salesinvoicedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function (e) {
            //     $j(this).datepicker('hide');
            // });
            $j("input[name='en_qty']").on("input", function () {
                var v = $j(this).val(), vc = v.replace(/[^0-9]/, '');
                if (v !== vc)
                    $j(this).val(vc);
            });

            $j("input[name='en_discount']").on("input", function () {
                var v = $j(this).val(), vc = v.replace(/[^0-9\.]/, '');
                if (v !== vc)
                    $j(this).val(vc);
            });
        })
        function add_detail(id) {
            var getid = id;
            document.getElementById("title_id").value = getid;
            document.getElementById("seq_field2").value = 0;
            $j("#detailbody").html("");
            $j("#particularDetailModal").modal('show');

        }
        $j('#particularDetailModal').on('shown.bs.modal', function () {
            //window.location="{{url('salesinvoice')}}"
            $j("input[type='text']").filter("[seq='101']").select();
        })
        $j("#btnAddDetail").on('click', function () {
            var gettitle_id = document.getElementById("title_id").value;
            var getseq = parseInt(document.getElementById("seq_field2").value);

            for (i = 0; i <= getseq; i++) {
                if (typeof $j("input[name='d_description_detail[" + i + "]']").val() != 'undefined') {

                    if ($j("input[name='d_special_field_detail[" + i + "]").val() == 1) {
                        var txt_color2 = "style='color:red;'";
                        var special_field_detail = 1;
                    } else {
                        var txt_color2 = "";
                        var special_field_detail = 0;
                    }
                    var newrow = $j('<tr>').addClass("row").attr("id", "inputFormRow")
                        .append($j('<td>').attr("scope", "col").addClass("col-sm-1"))
                        .append($j('<p>').append($j("<input>").attr("name", "detid[]").attr("type", "hidden").val($j("input[name='en_detid']").val())).append($j("<input>").attr("name", "stockid[]").attr("type", "hidden").val($j("input[name='en_stockid']").val())))
                        .append($j('<td>').addClass("col-sm-7").append($j("<input>").attr("name", "d_description_detail[" + gettitle_id + "][" + i + "]").attr("type", "hidden").val($j("input[name='d_description_detail[" + i + "]']").val())).append($j("<p " + txt_color2 + ">").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + $j("input[name='d_description_detail[" + i + "]']").val())))
                        .append($j('<td>').addClass("col-sm-2")).append($j("<input>").attr("name", "d_special_field_details[" + gettitle_id + "][" + i + "]").attr("type", "hidden").val(special_field_detail))
                        //  .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append(get_rate)))
                        .append($j('<td>').addClass("col").append(" "));
                    $j("#detailfield_" + gettitle_id).append(newrow);
                    document.getElementById("no").value = "";
                    document.getElementById("description").value = "";
                }
            }
            $j("#particularDetailModal").modal('hide');
        })
        var seq_field = 0;
        function js_add_item() {
            if ($j("input[name='description']").val() != "") {
                var editnum = $j(".editnum").html().trim();
                if (isNaN(parseInt(editnum, 10))) {
                    seq_field = seq_field + 1;

                    if ($j("input[name='specialfield']").is(":checked") == true) {
                        var txt_color = "style='color:red;'";
                        var special_field = 1;
                    } else {
                        var txt_color = "";
                        var special_field = 0;
                    }
                    var nseq = $j("input[name='stockid[]']").length + 1;
                    var newrow = $j('<tr>').addClass("row").attr("id", "inputFormRow")
                        .append($j('<td>').attr("scope", "col").addClass("col-sm-1").append($j("<input>").attr("name", "no[" + seq_field + "]").attr("type", "hidden").val($j("input[name='no']").val())).append($j("<p>").append($j("input[name='no']").val())))
                        .append($j('<p>').append($j("<input>").attr("name", "detid[]").attr("type", "hidden").val($j("input[name='en_detid']").val())).append($j("<input>").attr("name", "stockid[]").attr("type", "hidden").val($j("input[name='en_stockid']").val())))
                        .append($j('<td>').addClass("col-sm-7").append($j("<input>").attr("name", "d_description[" + seq_field + "]").attr("type", "hidden").val($j("input[name='description']").val())).append($j("<p " + txt_color + ">").append($j("input[name='description']").val())))
                        .append($j('<td>').addClass("col-sm-2")).append($j("<input>").attr("name", "d_specialfield[" + seq_field + "]").attr("type", "hidden").val(special_field))
                        //  .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append(get_rate)))
                        .append($j('<td>').addClass("col").append($j("<button>").addClass("btn btn-info btn-xs fas fa-plus").attr("type", "button").attr("title", "Add Detail").attr("onclick", "add_detail(" + seq_field + ")").attr("id", "addDetail_" + seq_field + "").text("")).append(" ").append($j("<button>").addClass("btn btn-warning btn-xs fas fa-trash").attr("type", "button").attr("id", "removeRow").text("")));
                    $j("#bodyitem").append($j("<div id='detailfield_" + seq_field + "'>").append(newrow));
                    document.getElementById("no").value = "";
                    document.getElementById("description").value = "";
                    document.getElementById("specialfield").checked = false;
                    $j("input[type='text']").filter("[seq='3']").select();
                } else {
                    $j("input[name='detid[]']").eq((editnum - 1)).val($j("input[name='en_detid']").val());
                    $j("input[name='d_description[]']").eq((editnum - 1)).val($j("input[name='description']").val());
                    document.getElementById("specialfield").checked = false;
                    document.getElementById("description").value = "";
                    document.getElementById("no").value = "";
                    $j("input[type='text']").filter("[seq='3']").select();
                }

            } else {
                alert("Particular is compulsory data!")

                $j("input[type='text']").filter("[seq='3']").select();
            }
            return false;
        }

        function js_add_item2() {
            var seq_field2 = parseInt(document.getElementById("seq_field2").value);
            if ($j("input[name='description_detail']").val() != "") {
                var editnum2 = $j(".editnum2").html().trim();
                if (isNaN(parseInt(editnum2, 10))) {
                    seq_field2 = seq_field2 + 1;
                    document.getElementById("seq_field2").value = seq_field2;
                    if ($j("input[name='specialfield_detail']").is(":checked") == true) {
                        var txt_color = "style='color:red;'";
                        var specialfield = 1;
                    } else {
                        var txt_color = "";
                        var specialfield = 0;
                    }
                    var nseq2 = $j("input[name='stockid2[]']").length + 1;
                    var newrow2 = $j('<tr>').addClass("row").attr("id", "inputFormRow2")
                        .append($j('<td>').attr("scope", "col").addClass("col-sm-1").append($j("<input>").attr("name", "no[" + seq_field + "]").attr("type", "hidden").val($j("input[name='no']").val())).append($j("<p>").append($j("input[name='no']").val())))
                        .append($j('<p>').append($j("<input>").attr("name", "detid2[]").attr("type", "hidden").val($j("input[name='en_detid2']").val())).append($j("<input>").attr("name", "stockid2[]").attr("type", "hidden").val($j("input[name='en_stockid2']").val())))
                        .append($j('<td>').addClass("col-sm-7").append($j("<input>").attr("name", "d_description_detail[" + seq_field2 + "]").attr("id", "d_description_detail_lgt").attr("type", "hidden").val($j("input[name='description_detail']").val())).append($j("<p " + txt_color + ">").append($j("input[name='description_detail']").val())).append($j("<div id='detailfield2_" + seq_field + "'>")))
                        .append($j('<td>').addClass("col-sm-2")).append($j("<input>").attr("name", "d_special_field_detail[" + seq_field2 + "]").attr("type", "hidden").val(specialfield))
                        //  .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append(get_rate)))
                        .append($j('<td>').addClass("col").append($j("<button>").addClass("btn btn-warning btn-xs fas fa-trash").attr("type", "button").attr("id", "removeRow2").text("")));
                    $j("#detailbody").append(newrow2);

                    document.getElementById("description_detail").value = "";
                    document.getElementById("specialfield_detail").checked = false;
                    $j("input[type='text']").filter("[seq='101']").select();
                } else {
                    $j("input[name='detid2[]']").eq((editnum2 - 1)).val($j("input[name='en_detid2']").val());
                    $j("input[name='d_description_detail[]']").eq((editnum2 - 1)).val($j("input[name='description_detail']").val());

                    document.getElementById("description_detail").value = "";
                    document.getElementById("specialfield_detail").checked = false;
                    $j("input[type='text']").filter("[seq='101']").select();
                }

            } else {
                alert("Particular detail is compulsory data!")
                $j("input[type='text']").filter("[seq='101']").select();
            }
            return false;
        }

        $j(document).on('click', '#removeRow', function () {
            $j(this).closest('#inputFormRow').remove();
        });
        $j(document).on('click', '#removeRow2', function () {
            $j(this).closest('#inputFormRow2').remove();
        });

        function js_delitem(num) {
            $j("#bodyitem").find("tr").eq((num - 1)).remove();
            $j("#bodyitem tr").each(function (i) {
                $j(this).find("td").eq(0).html((i + 1));
                $j(this).find("a").eq(1).attr("href", "javascript:js_delitem('" + (i + 1) + "');void(0);");
            })

        }

    </script>
@endsection

@section('topbar')

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

    </form>

@endsection


