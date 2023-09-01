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
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Leave Form</h1>
        </div>
        <!-- Page Heading END -->

        <div>

            @include('partials/messages')

            <form id="addleaveform" method="post" action="{{ action('App\Http\Controllers\LeaveFormsController@update', $leaveform->id) }}">
                @csrf

                <input type="hidden" name="printdo">
                <input type="hidden" name="salesnote">
                <input type="hidden" name="printnote">
                <input type="hidden" name="salesnotelist">
                <input type="hidden" name="total_rating" id="total_rating" value="0"/>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Staff Name:</label><span class="text-danger">*</span>
                        <input type="text" class="form-control enterseq" disabled seq="1" required name="staff_name" value="{{$leaveform->staff_name}}" id="staff_name">

                    </div>
                    <div class="col-3">
                        <label for="title">Designation:</label></label><span class="text-danger">*</span>
                        <input type="text" class="form-control enterseq" disabled seq="2" required name="designation" value="{{$leaveform->designation}}" id="designation">

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="acc_code">Leaves Type:</label></label><span class="text-danger">*</span><br>
                        <div class="col-12 row">
                            @php
                                $checked1 = '';
                                $checked2 = '';
                                $checked3 = '';
                                $checked4 = '';
                                $checked5 = '';
                                $checked6 = '';
                                if($leaveform->leave_typ=='Annual'){
                                  $checked1 = 'checked';
                                }
                                if($leaveform->leave_typ=='Marriage'){
                                  $checked2 = 'checked';
                                }
                                if($leaveform->leave_typ=='M.C'){
                                  $checked3 = 'checked';
                                }
                                if($leaveform->leave_typ=='Maternity'){
                                  $checked4 = 'checked';
                                }
                                if($leaveform->leave_typ=='No Pay'){
                                  $checked5 = 'checked';
                                }
                                if($leaveform->leave_typ=='Emergency'){
                                  $checked6 = 'checked';
                                }
                            @endphp
                            <div class="col-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" disabled value="Annual" {{$checked1}} required name="leave_typ">Annual
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" disabled value="Marriage" {{$checked2}} name="leave_typ">Marriage
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"value="M.C" disabled {{$checked3}} name="leave_typ">M.C.
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" disabled value="Maternity" {{$checked4}} name="leave_typ">Maternity
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" disabled value="No Pay" {{$checked5}} name="leave_typ">No Pay
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" disabled value="Emergency" {{$checked6}} name="leave_typ">Emergency
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Date : (from)</label>
                        <input type="text" seq="3" class="form-control enterseq" disabled name="leave_dat_frm" required id="leave_dat_frm" value="{{$leaveform->leave_dat_frm}}" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('leave_dat_frm') }}</span>
                    </div>
                    <div class="col-3">
                        <label for="title">Date : (To)</label>
                        <input type="text" seq="4" class="form-control enterseq" disabled name="leave_dat_to" required id="leave_dat_to" value="{{$leaveform->leave_dat_to}}" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('leave_dat_to') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Duration of leave:</label>
                        <input type="text" class="form-control enterseq" disabled seq="5" readonly name="leave_duration" value="{{$leaveform->leave_duration}}" id="leave_duration">

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <label for="title">Reason of leave:</label>
                        <input type="text" class="form-control enterseq" disabled seq="6" required name="leave_reason" value="{{$leaveform->leave_reason}}"  id="leave_reason">

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-10">
                        <label for="systemfile56">Files Upload (Max upload size : {{$data['systemsetting']->uploadfilelimit}} MB): <span id="hardware_note" style="color:red;"></span></label>
                        @php
                            $imageDir = public_path('leave_form/'.$leaveform->doc_no);
                            $images = [];
                            if(is_dir($imageDir)) {
                              foreach (scandir($imageDir) as $path) {
                                  if (!is_dir($imageDir . '/' . $path)) {
                                      $images[] = $path;
                                  }
                              }
                            }
                        @endphp
                        </br>
                        @foreach($images as $i)
                            <a target="blank" href="{{ URL::to('/') }}/leave_form/{{$leaveform->doc_no}}/{{$i}}">{{$i}}</a> </br>
                            @endforeach
                            </br>
                            <input type="file" seq="11" class="form-control enterseq" onchange="ValidateSize(this)" name="upload_file[]" id="upload_file" multiple/>
                            <span class="text-danger">{{ $errors->first('upload_file') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Approval Status:</label>
                        @can('APPROVE LEAVE FORM')
                            <select seq="7" class="form-control enterseq" disabled id="status" name="status">
                                <option {{(($leaveform->status =='1')?"selected":"")}} value="1">Approve</option>
                                <option {{(($leaveform->status =='2')?"selected":"")}} value="2">Pending</option>
                                <option {{(($leaveform->status =='0')?"selected":"")}} value="0">Reject</option>
                            </select>
                        @else
                            <select seq="7" readonly class="form-control enterseq" id="status" name="status">
                                @if($leaveform->status=='1')
                                    <option {{(($leaveform->status =='1')?"selected":"")}} value="1">Approve</option>
                                @endif
                                @if($leaveform->status=='2')
                                    <option {{(($leaveform->status =='2')?"selected":"")}} value="2">Pending</option>
                                @endif
                                @if($leaveform->status=='0')
                                    <option {{(($leaveform->status =='0')?"selected":"")}} value="0">Reject</option>
                                @endif
                            </select>
                        @endcan
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\LeaveFormsController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
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
            <div class="modal fade" id="particularDetailModal" tabindex="-1" role="dialog" aria-labelledby="particularDetailModalLabel" aria-hidden="true">
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
                                    <input type="hidden" class="form-control col-10" name="seq_field2" id="seq_field2" value="0">
                                    <input type="hidden" class="form-control col-10" name="title_id" id="title_id" value="">

                                </div>
                            </div>
                            <div class="form-group">
                                <table id="servicesalestbl" class="table table-striped">
                                    <thead class="thead-light">
                                    <tr class="row">
                                        <th scope="col" class="editnum2">&nbsp;</th>

                                        <th class="col-sm-5"><input type='text' name='description_detail' id="description_detail"  seq="101" class="form-control enterseq"></th>
                                        <th class="col-sm-2">
                                            <div class="custom-control custom-switch">

                                                <input type="checkbox" class="custom-control-input enterseq" seq="102" id="specialfield_detail" name="specialfield_detail">
                                                <label class="custom-control-label" for="specialfield_detail">Red color</label>
                                            </div>
                                        </th>
                                        <th class="col-sm-1">
                                            <div class="custom-control custom-switch">

                                                <input type="checkbox" class="custom-control-input enterseq" seq="103" id="detail_input_flag" name="detail_input_flag">
                                                <label class="custom-control-label" for="detail_input_flag">Input</label>
                                            </div>
                                        </th>
                                        <th class="col-sm-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input enterseq" seq="104" id="detailspacefield" name="detailspacefield">
                                                <label class="custom-control-label" for="detailspacefield">AllowSpace</label>
                                            </div>
                                        </th>

                                        <th><button type="button" class="btn btn-info enterseq" seq="105" id="addspecialfield_detail" name="addspecialfield_detail">Add</button> </th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr class="row">
                                        <th></th>
                                        <th class="col-sm-6">Particular</th>
                                        <th class="col-sm-1"></th>
                                        <th class="col-sm-1"></th>
                                        <th class="col-sm-1"></th>
                                        <th class="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="detailbody">

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button data-dismiss="modal" class="btn btn-secondary btn-xs" id="btnBack">Cancel</button> <button class="btn btn-primary" id="btnAddDetail">Confirm</button>
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

@section('footerjs')
    <script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/base.js') }}"></script>
    <script type="text/javascript">

        if ($("#salesform").length > 0) {
            $("#salesform").validate({
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
                                } if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='checkbox']")) {
                                    $("input[type='checkbox']").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $("select").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='date']")){
                                    $("input[type='date']").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            if($(this).attr("name")=="leave_dat_frm"){
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
                            if($(this).attr("name")=="leave_dat_to"){
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

                        return false;
                    }
                    if(keycode==38){
                        if($(this).attr("name")=="attention"){
                            $(".customerAutoSelect").select();
                        }
                        if($(this).attr("name")=="en_description"){
                            $(".stockAutoSelect").select();
                        }
                    }
                })
            })

            $("input[name='effectivedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
                $(this).datepicker('hide');
            });



            $("input[name='effectivedate']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                switch(keycode) {
                    case 13:
                        $("#btnAction").focus();
                        return false;
                        break;
                }
            })
            ck = CKEDITOR.replace('modal_note');
            ck.on('key', function (event) {
                var keycode = (event.data.keyCode ? event.data.keyCode : event.data.which);
                if(keycode==27){
                    $("#noteModal .close").click();
                    return false;
                } else if(keycode==113){
                    $("#noteModal #btnSaveNote").focus();
                    return false;
                }
            })
            $("input[name='en_note']").focus(function(evt){
                var modal = $('#noteModal').modal({
                    backdrop: 'static',
                    keyboard: true
                });
                setTimeout(function(){
                    ck.focus();
                    if($("input[name='en_note']").val()!=""){
                        ck.setData($("input[name='en_note']").val());
                    } else {
                        ck.setData(" &nbsp; ");
                    }
                },1000);
                $("#btnSaveNote").unbind('click');
                $("#btnSaveNote").click(function(evt){
                    var data = ck.getData();
                    $("input[name='en_note']").val(data);
                    $("#noteModal .close").click();
                    ck.setData("");
                    return false;
                })
                $('#noteModal').on('hidden.bs.modal', function () {
                    $("input[name='en_qty']").select();
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



            setTimeout(function(){ if($(".searchInvNo").length>0){ $(".searchInvNo").select(); } else { $('.customerAutoSelect').select(); } }, 100);
            $("input[name='salesinvoicedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
                $(this).datepicker('hide');
            });
            $("input[name='en_qty']").on("input", function() {
                var v= $(this).val(), vc = v.replace(/[^0-9]/, '');
                if (v !== vc)
                    $(this).val(vc);
            });

            $("input[name='en_discount']").on("input", function() {
                var v= $(this).val(), vc = v.replace(/[^0-9\.]/, '');
                if (v !== vc)
                    $(this).val(vc);
            });


        })

        $("input[name='leave_dat_frm']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
            $(this).datepicker('hide');
            get_leave_day();
        });


        $("input[name='leave_dat_frm']").keydown(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            switch(keycode) {
                case 13:
                    $("#leave_dat_to").focus();
                    get_leave_day();
                    return false;
                    break;
            }
        })

        $("input[name='leave_dat_to']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
            $(this).datepicker('hide');
            get_leave_day();

        });


        $("input[name='leave_dat_to']").keydown(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            switch(keycode) {
                case 13:
                    $("#leave_dat_to").focus();
                    get_leave_day();
                    return false;
                    break;
            }
        })
        function add_detail(id){
            var getid = id;
            document.getElementById("title_id").value = getid;
            document.getElementById("seq_field2").value = 0;
            $("#detailbody").html("");
            $("#particularDetailModal").modal('show');

        }

        function get_leave_day(){
            var leave_dat_frm0 = $("#leave_dat_frm").val();
            var leave_dat_to0 = $("#leave_dat_to").val();
            var leave_dat_frm = new Date(leave_dat_frm0.split('/').reverse().join('-'));
            var leave_dat_to = new Date(leave_dat_to0.split('/').reverse().join('-'));

            if(leave_dat_frm0!='' && leave_dat_to0!=''){
                if(leave_dat_frm > leave_dat_to){
                    alert("Date (To) Cannot less than Date (From)");
                    $("#leave_dat_to").focus();
                    $("#leave_dat_to").val("");
                    $("#leave_duration").val(0);
                } else {

                    var today = leave_dat_frm0;
                    today = new Date(today.split('/')[2],today.split('/')[1]-1,today.split('/')[0]);
                    var date2 = leave_dat_to0;
                    date2 = new Date(date2.split('/')[2],date2.split('/')[1]-1,date2.split('/')[0]);
                    var timeDiff = Math.abs(date2.getTime() - today.getTime());
                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    var diffday = diffDays+1;
                    $("#leave_duration").val(diffday);

                }
            }
        }

        var seq_field = 0;

        function validatenumber_c1(myfield, e, dec)
        {

            var key;
            var keychar;

            if (window.event)
                key = window.event.keyCode;
            else if (e)
                key = e.which;
            else
                return true;
            keychar = String.fromCharCode(key);

            // control keys
            if ((key==null) || (key==0) || (key==8) ||
                (key==9) || (key==13) || (key==27) )
                return true;

            // numbers
            else if ((("0123456789.").indexOf(keychar) > -1)){
                return true;

            }

            else
                return false;

        }

        function get_total_rating(){
            var total_amt = 0;
            var input = $(".d_max_rating").length;
            if(seq_field>0){
                for (var iv = 0; iv <= seq_field; iv++) {
                    var amt =  $("#d_max_rating_"+iv).val();
                    if($("#d_max_rating_"+iv).val()){
                        total_amt += parseInt(amt);
                    }
                }
            } else {
                var total_amt = 0;
            }
            return total_amt;
        }
    </script>
@endsection

@section('topbar')

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

    </form>

@endsection


