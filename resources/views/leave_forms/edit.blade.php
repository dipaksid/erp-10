@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Leave Form</h1>
        </div>
        <!-- Page Heading End -->

        @include('partials/messages')

        <form id="addleaveform" method="post" action="{{action('App\Http\Controllers\LeaveFormsController@update', $leaveform->id)}}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="printdo">
            <input type="hidden" name="salesnote">
            <input type="hidden" name="printnote">
            <input type="hidden" name="salesnotelist">
            <input type="hidden" name="total_rating" id="total_rating" value="0"/>

            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Staff Name:</label><span class="text-danger">*</span>
                    <input type="text" class="form-control enterseq" seq="1" required name="staff_name" value="{{$leaveform->staff_name}}" id="staff_name">

                </div>
                <div class="col-3">
                    <label for="title">Designation:</label></label><span class="text-danger">*</span>
                    <input type="text" class="form-control enterseq" seq="2" required name="designation" value="{{$leaveform->designation}}" id="designation">

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
                                    <input type="radio" class="form-check-input" value="Annual" {{$checked1}} required name="leave_typ">Annual
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Marriage" {{$checked2}} name="leave_typ">Marriage
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"value="M.C" {{$checked3}} name="leave_typ">M.C.
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Maternity" {{$checked4}} name="leave_typ">Maternity
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="No Pay" {{$checked5}} name="leave_typ">No Pay
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Emergency" {{$checked6}} name="leave_typ">Emergency
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Date : (from)</label>
                    <input type="text" seq="3" class="form-control enterseq datetime-local" name="leave_dat_frm" required id="leave_dat_frm" value="{{$leaveform->leave_dat_frm}}" maxlength="10"/>
                    <span class="text-danger">{{ $errors->first('leave_dat_frm') }}</span>
                </div>
                <div class="col-3">
                    <label for="title">Date : (To)</label>
                    <input type="text" seq="4" class="form-control enterseq datetime-local" name="leave_dat_to" required id="leave_dat_to" value="{{$leaveform->leave_dat_to}}" maxlength="10"/>
                    <span class="text-danger">{{ $errors->first('leave_dat_to') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Duration of leave:</label>
                    <input type="text" class="form-control enterseq" seq="5" onKeyPress="return validatenumber_c1(this, event);" name="leave_duration" value="{{$leaveform->leave_duration}}" id="leave_duration">

                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label for="title">Reason of leave:</label>
                    <input type="text" class="form-control enterseq" seq="6" required name="leave_reason" value="{{$leaveform->leave_reason}}"  id="leave_reason">

                </div>
            </div>
            <div class="row form-group">
                <div class="col-10">
                    <label for="systemfile56">Files Upload (Max upload size : {{$systemSetting->uploadfilelimit}} MB): <span id="hardware_note" style="color:red;"></span></label>
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
                        $counti=0;
                    @endphp
                    </br>
                    <div id="doc_list">
                        @foreach($images as $i)
                            @php $counti++; @endphp
                            <div>{{$counti}}. <a target="blank" href="{{ URL::to('/') }}/leave_form/{{$leaveform->doc_no}}/{{$i}}">{{$i}} <input type="hidden" id="getdoc{{$counti}}" value="{{$i}}" /> </a> @if($leaveform->status==2)<button onclick="ask_delete({{ $counti }})" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash"></i></button>@endif </div>
                        @endforeach
                    </div>
                    </br>
                    <input type="hidden" id="current_active_id" value="" />
                    <input type="hidden" id="current_active_doc_delete" value="{{$leaveform->doc_no}}" />
                    <input type="file" seq="11" class="form-control enterseq" onchange="ValidateSize(this)" name="upload_file[]" id="upload_file" multiple/>
                    <span class="text-danger">{{ $errors->first('upload_file') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Approval Status:</label>
                    @can('APPROVE LEAVE FORM')
                        <select seq="7" class="form-control enterseq" id="status" name="status">
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
            <button type="submit" seq="7" class="btn btn-primary enterseq" id="btnAction">Update</button>
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
        <div class="modal fade" id="deleteDocModal" tabindex="-1" role="dialog" aria-labelledby="deleteDocModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="noteModalLabel">Delete Documents</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                File will directly delete. Are you sure that want to delete this file?
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" id="btnYesDelete">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        flatpickr(".datetime-local", { dateFormat: 'd/m/Y' });
    </script>
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
                                } if($j(".enterseq").filter("[seq='"+dd+"']").is("input[type='checkbox']")) {
                                    $j("input[type='checkbox']").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $j("select").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("input[type='date']")){
                                    $j("input[type='date']").filter("[seq='"+dd+"']").focus();
                                } else if($j(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $j("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            if($j(this).attr("name")=="leave_dat_frm"){
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
                            if($j(this).attr("name")=="leave_dat_to"){
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
                        if($j(this).attr("name")=="en_qty" || $j(this).attr("name")=="en_unitprice" || $j(this).attr("name")=="en_discount"){
                            if($j(this).attr("name")=="en_qty" && $j(this).val()<=0){
                                $j(this).select();
                                return false;
                            }
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
            // $j("input[name='effectivedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
            //     $j(this).datepicker('hide');
            // });
            // $j("input[name='effectivedate']").keydown(function(event){
            //     var keycode = (event.keyCode ? event.keyCode : event.which);
            //     switch(keycode) {
            //         case 13:
            //             $j("#btnAction").focus();
            //             return false;
            //             break;
            //     }
            // })
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
            $j("input[name='en_discount']").on("input", function() {
                var v= $j(this).val(), vc = v.replace(/[^0-9\.]/, '');
                if (v !== vc)
                    $j(this).val(vc);
            });
        })
        // $j("input[name='leave_dat_frm']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
        //     $j(this).datepicker('hide');
        //     get_leave_day();
        // });
        $j("input[name='leave_dat_frm']").keydown(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            switch(keycode) {
                case 13:
                    $j("#leave_dat_to").focus();
                    get_leave_day();
                    return false;
                    break;
            }
        })
        // $j("input[name='leave_dat_to']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
        //     $j(this).datepicker('hide');
        //     get_leave_day();
        // });
        $j("input[name='leave_dat_to']").keydown(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            switch(keycode) {
                case 13:
                    $j("#leave_dat_to").focus();
                    get_leave_day();
                    return false;
                    break;
            }
        })
        function add_detail(id){
            var getid = id;
            document.getElementById("title_id").value = getid;
            document.getElementById("seq_field2").value = 0;
            $j("#detailbody").html("");
            $j("#particularDetailModal").modal('show');
        }
        function get_leave_day(){
            var leave_dat_frm0 = $j("#leave_dat_frm").val();
            var leave_dat_to0 = $j("#leave_dat_to").val();
            var leave_dat_frm = new Date(leave_dat_frm0.split('/').reverse().join('-'));
            var leave_dat_to = new Date(leave_dat_to0.split('/').reverse().join('-'));

            if(leave_dat_frm0!='' && leave_dat_to0!=''){
                if(leave_dat_frm > leave_dat_to){
                    alert("Date (To) Cannot less than Date (From)");
                    $j("#leave_dat_to").focus();
                    $j("#leave_dat_to").val("");
                    $j("#leave_duration").val(0);
                } else {
                    var today = leave_dat_frm0;
                    today = new Date(today.split('/')[2],today.split('/')[1]-1,today.split('/')[0]);
                    var date2 = leave_dat_to0;
                    date2 = new Date(date2.split('/')[2],date2.split('/')[1]-1,date2.split('/')[0]);
                    var timeDiff = Math.abs(date2.getTime() - today.getTime());
                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    var diffday = diffDays+1;
                    $j("#leave_duration").val(diffday);
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
            var input = $j(".d_max_rating").length;
            if(seq_field>0){
                for (var iv = 0; iv <= seq_field; iv++) {
                    var amt =  $j("#d_max_rating_"+iv).val();
                    if($j("#d_max_rating_"+iv).val()){
                        total_amt += parseInt(amt);
                    }
                }
            } else {
                var total_amt = 0;
            }
            return total_amt;
        }
        function ValidateSize(file) {
            var filename = file.value;
            var lastIndex = filename.lastIndexOf("\\");
            if (lastIndex >= 0) {
                filename = filename.substring(lastIndex + 1);
            }
            var files = $j('#upload_file')[0].files;
            var totalSize = 0;

            for (var i = 0; i < files.length; i++) {
                // calculate total size of all files
                totalSize += files[i].size;
            }
            var FileSize = file.files[0].size / 1024/1024; // in MiB
            if ((totalSize/1024/1024) > filesizelimit) {
                alert('File size exceeds '+filelimit+' MB');
                $j(file).val('');
            }
        }
        function ask_delete(value){
            $j("#current_active_id").val(value);

            $j("#deleteDocModal").modal("show");

        }
        $j("#btnYesDelete").on('click',function(){

            var getid = $j("#current_active_id").val();

            var docname = $j("#getdoc"+getid).val();
            var docno = $j("#current_active_doc_delete").val();
            delete_file_doc(docname,docno);

        })
        function delete_file_doc(docname,docno){
            $j.ajax({
                url:"{{action('App\Http\Controllers\LeaveFormsController@docdelete')}}",
                type:'get',
                data:{docname:docname,docno:docno},
                success: function(json){
                    if(json!=""){
                        $j("#doc_list").html("");
                        $j.each(json['filedata'], function(index, value) {
                            var link = value.filename;
                            var data_docno = value.docno;
                            var data_id = value.id;
                            var url = "{{ URL::to('/') }}";
                            var redirect_url = url + '/leave_form/'+value.docno+'/'+link;
                            var newrow = '';
                            newrow += "<div>"+data_id+". <a target='blank' href='"+redirect_url+"'>"+link+" <input type='hidden' id='getdoc"+data_id+"' value='"+link+"' /> </a> <button onclick='ask_delete("+data_id+")' class='btn btn-danger btn-sm' type='button'><i class='fa fa-trash'></i></button> </div>";
                            $j("#doc_list").append(newrow);
                        })
                    }
                },complete: function(json){
                    alert("Document deleted")
                    $j("#deleteDocModal").modal("hide");
                    $j("#current_active_id").val("");
                }
            })
        }
    </script>
@endsection

@section('topbar')
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

    </form>
@endsection

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
