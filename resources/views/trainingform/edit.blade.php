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
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Training Form</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="trainingform" method="post" action="{{action('App\Http\Controllers\TrainingFormsController@update', $trainingform->id)}}">
                @csrf
                @method('PATCH')

                <input type="hidden" name="printdo">
                <input type="hidden" name="salesnote">
                <input type="hidden" name="printnote">
                <input type="hidden" name="salesnotelist">

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">System:</label>
                        <select class="form-control enterseq" seq="1" name="systemcod" id="systemcod">
                            <option value=""> -- Selection --</option>
                            @foreach($data['customercategory'] as $ckey => $rowcat)
                                <option {{(($trainingform->systemcod == $rowcat['categorycode'])?"selected":"")}} value="{{$rowcat['categorycode']}}">{{$rowcat['categorycode']}} - {{$rowcat['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control enterseq" seq="2" name="form_title" value="{{$trainingform->form_title}}" id="form_title">
                        <input type="hidden" class="form-control col-10" name="seq_field" id="seq_field" value="0">
                    </div>
                </div>

                <table class="table">
                    <thead class="thead-light">
                    <tr class="d-flex">
                        <th scope="col" class="editnum col-sm-1"><input type='text' name='no' id="no"  seq="3" class="form-control enterseq"></th>
                        <th class="col-sm-6"><input type='text' name='description' id="description"  seq="4" class="form-control enterseq"></th>
                        <th class="col-sm-1">
                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input enterseq" seq="5" id="specialfield" name="specialfield">
                                <label class="custom-control-label" for="specialfield">Red color</label>
                            </div>
                        </th>
                        <th class="col-sm-1">
                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input enterseq" seq="6" id="input_flag" name="input_flag">
                                <label class="custom-control-label" for="input_flag">Input</label>
                            </div>
                        </th>
                        <th class="col-sm-1">
                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input enterseq" seq="7" id="spacefield" name="spacefield">
                                <label class="custom-control-label" for="spacefield">Allow Space</label>
                            </div>
                        </th>
                        <th><button type="button" class="btn btn-info enterseq" seq="8" id="addfield" name="addfield">Add</button></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr class="d-flex">
                        <th class="col-sm-1">NO</th>
                        <th class="col-sm-6">Particular</th>
                        <th class="col-sm-1"></th>
                        <th class="col-sm-1"></th>
                        <th class="col-sm-1"></th>
                        <th class="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="bodyitem">

                    </tbody>

                </table>
                <a href="{{ action('App\Http\Controllers\TrainingFormsController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
                <button type="submit" class="btn btn-primary btn-xs" id="btnSubmit">Save</button>
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
                                    <tr class="d-flex">
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

                                                <input type="checkbox" class="custom-control-input enterseq" seq="103" title="Input" id="detail_input_flag" name="detail_input_flag">
                                                <label class="custom-control-label" title="Input" for="detail_input_flag">Input</label>
                                            </div>
                                        </th>
                                        <th class="col-sm-2">
                                            <div class="custom-control custom-switch">

                                                <input type="checkbox" class="custom-control-input enterseq" seq="104" id="spacefield_detail" name="spacefield_detail">
                                                <label class="custom-control-label" for="spacefield_detail">AllowSpace</label>
                                            </div>
                                        </th>
                                        <th><button type="button" class="btn btn-info enterseq" seq="105" id="addspecialfield_detail" name="addspecialfield_detail">Add</button> </th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr class="d-flex">
                                        <th ></th>
                                        <th class="col-sm-5">Particular</th>
                                        <th class="col-sm-2"></th>
                                        <th class="col-sm-1"></th>
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
                                    <button data-dismiss="modal" class="btn btn-secondary btn-xs" id="btnBack">Cancel</button>
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
        var id = "{{ $trainingform->id }}";
        var bsavenote=false;
        var bsave=false;
        var fileName1="";
        var searchtrigger=false;
        var ck;
        var uomsid="";
        var prtopt="";
        var num = 0;
        function gettitleTable(id){
            data2="id="+id;
            $j.ajax({
                url:"{{ action('App\Http\Controllers\TrainingFormsController@trainingformList') }}",
                type:'get',
                dataType: 'json',
                data:data2,
                success: function(json){
                    if(json.msg=="success"){
                        $("#bodyitem").empty();
                        if(Object.keys(json.datalist).length>0){

                            $j.each(json.datalist,function(i,v){
                                var show = 0;
                                var tr = "";
                                if(v.no == '' || v.no == null){
                                    var no = '';
                                } else {
                                    var no = v.no;
                                }
                                if(v.special == 1){
                                    var checked = "checked";
                                } else {
                                    var checked = '';
                                }
                                if(v.space_lvl == 1){
                                    var schecked = "checked";
                                } else {
                                    var schecked = '';
                                }
                                if(v.input_flag == 1){
                                    var ichecked = "checked";
                                } else {
                                    var ichecked = '';
                                }
                                num++;
                                tr += "<tr class=\"d-flex\" id=\"inputFormRow\">";
                                tr += "<td class=\"col-sm-1\" scope=\"col\"><input name=\"no["+num+"]\" class=\"form-control enterseq\" type=\"text\" value=\""+no+"\" ><p><input name=\"detid[]\" type=\"hidden\" value=\"\" ><input name=\"stockid[]\" type=\"hidden\" value=\"\" ></p></td>";
                                tr += "<td class=\"col-sm-6\"><input class=\"form-control enterseq\" id=\"d_description\" name=\"d_description["+num+"]\" type=\"text\" value=\""+v.particular+"\" ></td>";
                                tr += "<td class=\"col-sm-1\"><input type=\"hidden\" name=\"d_id["+num+"]\" value=\""+v.id+"\" /><div class=\"custom-control custom-switch enterseq\"><input type=\"checkbox\" "+checked+" class=\"custom-control-input\" id=\"d_specialfield["+num+"]\" name=\"d_specialfields["+num+"]\"><label class=\"custom-control-label\" for=\"d_specialfield["+num+"]\">Red color</label></div></td>";
                                tr += "<td class=\"col-sm-1\"><div class=\"custom-control custom-switch enterseq\"><input type=\"checkbox\" "+ichecked+" class=\"custom-control-input\" id=\"d_input_flag["+num+"]\" name=\"d_input_flags["+num+"]\"><label class=\"custom-control-label\" for=\"d_input_flag["+num+"]\">Input</label></div></td>";
                                tr += "<td class=\"col-sm-1\"><div class=\"custom-control custom-switch enterseq\"><input type=\"checkbox\" "+schecked+" class=\"custom-control-input\" id=\"d_spacefield["+num+"]\" name=\"d_spacefields["+num+"]\"><label class=\"custom-control-label\" for=\"d_spacefield["+num+"]\">Allow Space</label></div></td>";
                                tr += "<td class=\"col\"><button class=\"btn btn-info btn-xs fas fa-plus enterseq\" type=\"button\" title=\"Add Detail\" onclick=\"add_detail("+num+")\" id=\"addDetail_"+num+"\"></button> <button class=\"btn btn-warning btn-xs fas fa-trash\" type=\"button\" id=\"removeRow\"></button></td>";
                                tr += "</tr>";
                                document.getElementById("seq_field").value = num;
                                var num2=0;
                                if(Object.keys(json.sublist).length>0){

                                    $j.each(json.sublist,function(i2,v2){

                                        if(v2.detail_id == v.id){
                                            if(v2.special == 1){
                                                var checked2 = "checked";
                                            } else {
                                                var checked2 = "";
                                            }
                                            if(v2.space_lvl== 1){
                                                var schecked2 = "checked";
                                            } else {
                                                var schecked2 = "";
                                            }
                                            if(v2.input_flag== 1){
                                                var ichecked2 = "checked";
                                            } else {
                                                var ichecked2 = "";
                                            }
                                            num2++;
                                            tr += "<div id=\"subfield_"+num+"\">";
                                            tr += "<tr class=\"row\" id=\"inputFormRow\">";
                                            tr += "<td class=\"col-sm-1\" scope=\"col\"><p><input name=\"detid[]\" type=\"hidden\" value=\"\" ><input name=\"stockid[]\" type=\"hidden\" value=\"\" ></p></td>";
                                            tr += "<td class=\"col-sm-1\"><input type=\"hidden\" name=\"d_detail_id["+num+"]["+num2+"]\" value=\""+v2.id+"\" /></td>";
                                            tr += "<td class=\"col-sm-5\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"form-control\" name=\"d_description_detail["+num+"]["+num2+"]\" type=\"text\" value=\""+v2.particular+"\" ></td>";
                                            tr += "<td class=\"col-sm-1\"><div class=\"custom-control custom-switch\"><input type=\"checkbox\" "+checked2+" class=\"custom-control-input\" id=\"d_detail_specialfield["+num+"]["+num2+"]\" name=\"d_detail_specialfield["+num+"]["+num2+"]\"><label class=\"custom-control-label\" for=\"d_detail_specialfield["+num+"]["+num2+"]\">Red color</label></div></td>";
                                            tr += "<td class=\"col-sm-1\"><div class=\"custom-control custom-switch\"><input type=\"checkbox\" "+ichecked2+" class=\"custom-control-input\" id=\"d_detail_input_flags["+num+"]["+num2+"]\" name=\"d_detail_input_flags["+num+"]["+num2+"]\"><label class=\"custom-control-label\" for=\"d_detail_input_flags["+num+"]["+num2+"]\">Input</label></div></td>";
                                            tr += "<td class=\"col-sm-1\"><div class=\"custom-control custom-switch\"><input type=\"checkbox\" "+schecked2+" class=\"custom-control-input\" id=\"d_detail_spacefield["+num+"]["+num2+"]\" name=\"d_detail_spacefield["+num+"]["+num2+"]\"><label class=\"custom-control-label\" for=\"d_detail_spacefield["+num+"]["+num2+"]\">AllowSpace</label></div></td>";
                                            tr += "<td class=\"col\"><button class=\"btn btn-warning btn-xs fas fa-trash\" type=\"button\" id=\"removeRow\"></button></td>";
                                            tr += "</tr>";
                                            tr += "</div>";
                                        }

                                    })

                                }

                                $("#bodyitem").append($("<div id='detailfield_"+num+"'>").append(tr).append($("<input id=\"detailseq_"+num+"\" name=\"stockid[]\" type=\"hidden\" value=\""+num2+"\" >")));
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
                            })


                        }
                    }
                }
            })
        }
        function getsubtitle(id){
            var num2 = 0;
            var main_seq = parseInt(document.getElementById("seq_field").value);
            data2="id="+id;
            $j.ajax({
                url:"{{ action('App\Http\Controllers\TrainingFormsController@trainingformList') }}",
                type:'get',
                dataType: 'json',
                data:data2,
                success: function(json){
                    if(json.msg=="success"){
                        if(Object.keys(json.sublist).length>0){
                            var tr2 = "";
                            $j.each(json.sublist,function(i,v){
                                for(j=0;j<=main_seq;j++){
                                    if(v.detail_id == $j("input[name='d_id["+j+"]']").val()){

                                        tr2 += "<tr class=\"d-flex\" id=\"inputFormRow\">";
                                        tr2 += "<td class=\"col-sm-1\" scope=\"col\"><p><input name=\"detid[]\" type=\"hidden\" value=\"\" ><input name=\"stockid[]\" type=\"hidden\" value=\"\" ></p></td>";
                                        tr2 += "<td class=\"col-sm-7\">"+v.particular+" <input name=\"d_description_detail["+j+"]\" type=\"text\" value=\""+v.particular+"\" ></td>";
                                        tr2 += "<td class=\"col-sm-2\"></td>";
                                        tr2 += "<td class=\"col\"></td>";
                                        tr2 += "</tr>";

                                        $j("#detailfield_"+j).append(tr2);
                                    }
                                }
                            })

                        }
                    }
                }
            })

        }
        $j(document).ready(function(evt){
            gettitleTable(id);

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
                            if($j(this).attr("name")=="effectivedate"){
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
                        if($j(this).attr("name")=="addspecialfield_detail"){
                            js_add_item2();
                        }
                        if($j(this).attr("name")=="addfield"){
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
            // $j("input[name='effectivedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
            //     $j(this).datepicker('hide');
            // });
            flatpickr("input[name='effectivedate']", { dateFormat: 'dd/mm/yyyy' });

            $j("#addspecialfield_detail").on('click',function(){
                js_add_item2();
            })
            $j("#addfield").on('click',function(){
                js_add_item();
            })
            $j("input[name='effectivedate']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                switch(keycode) {
                    case 13:
                        $j("#btnAction").focus();
                        return false;
                        break;
                }
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
            flatpickr("input[name='salesinvoicedate']", { dateFormat: 'dd/mm/yyyy' });
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
        function add_detail(id){
            var getid = id;
            document.getElementById("title_id").value = getid;
            document.getElementById("seq_field2").value = document.getElementById("detailseq_"+getid).value;
            $j("#detailbody").html("");
            $j("#particularDetailModal").modal('show');

        }
        $j('#particularDetailModal').on('shown.bs.modal', function () {
            //  window.location="{{url('salesinvoice')}}"
            $j("input[type='text']").filter("[seq='101']").select();
        })
        $j("#btnAddDetail").on('click', function(){
            var gettitle_id = document.getElementById("title_id").value;
            var getseq = parseInt(document.getElementById("seq_field2").value);

            for(i=0;i<=getseq;i++){
                if(typeof $j("input[name='d_description_detail["+i+"]']").val() != 'undefined'){

                    if($j("input[name='d_special_field_detail["+i+"]").val() == 1 ){
                        var txt_color2 = "style='color:red;'";
                        var special_field_detail = 1;
                        var checked = "checked";
                    } else {
                        var txt_color2 = "";
                        var special_field_detail = 0;
                        var checked = "";
                    }

                    if($j("input[name='d_space_field_detail["+i+"]").val() == 1 ){
                        var spacefielddetail = 1;
                        var spacefield_detail = 'style="margin-left:80px;"';
                        var scheck = 'checked';
                    } else {
                        var spacefielddetail = 0;
                        var spacefield_detail = '';
                        var scheck = '';
                    }

                    if($j("input[name='d_detail_input_flag["+i+"]").val() == 1 ){
                        var icheck = 'checked';
                    } else {
                        var icheck = '';
                    }
                    var newrow = $j('<tr>').addClass("d-flex").attr("id","inputFormRow")
                        .append($j('<td>').attr("scope","col").addClass("col-sm-1"))
                        .append($j('<p>').append($j("<input>").attr("name","detid[]").attr("type","hidden").val($j("input[name='en_detid']").val())).append($j("<input>").attr("name","stockid[]").attr("type","hidden").val($j("input[name='en_stockid']").val())) )
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("class","form-control").attr("name","d_detail_id["+gettitle_id+"]["+i+"]").attr("type","hidden").val(0)))
                        .append($j('<td>').addClass("col-sm-5").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;").append($j("<input>").attr("class","form-control enterseq").attr("name","d_description_detail["+gettitle_id+"]["+i+"]").attr("type","text").val($j("input[name='d_description_detail["+i+"]']").val())).append( $j("<p "+txt_color2+">")))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_special_field_details["+gettitle_id+"]["+i+"]").attr("type","hidden").val(special_field_detail)).append($j("<div>").attr("class","custom-control custom-switch enterseq").append($j("<input "+checked+">").attr("type","checkbox").attr("class","custom-control-input").attr("id","d_detail_specialfield["+gettitle_id+"]["+i+"]").attr("name","d_detail_specialfield["+gettitle_id+"]["+i+"]")).append($j("<label>").attr("class","custom-control-label").attr("for","d_detail_specialfield["+gettitle_id+"]["+i+"]").append("Red color"))))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_detail_input_flags["+gettitle_id+"]["+i+"]").attr("type","hidden").val(icheck)).append($j("<div>").attr("class","custom-control custom-switch enterseq").append($j("<input "+icheck+">").attr("type","checkbox").attr("class","custom-control-input").attr("id","d_detail_input_flag["+gettitle_id+"]["+i+"]").attr("name","d_detail_input_flags["+gettitle_id+"]["+i+"]")).append($j("<label>").attr("class","custom-control-label").attr("for","d_detail_input_flag["+gettitle_id+"]["+i+"]").append("Input"))))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_space_field_details["+gettitle_id+"]["+i+"]").attr("type","hidden").val(spacefielddetail)).append($j("<div>").attr("class","custom-control custom-switch enterseq").append($j("<input "+scheck+">").attr("type","checkbox").attr("class","custom-control-input").attr("id","d_detail_spacefield["+gettitle_id+"]["+i+"]").attr("name","d_detail_spacefield["+gettitle_id+"]["+i+"]")).append($j("<label>").attr("class","custom-control-label").attr("for","d_detail_spacefield["+gettitle_id+"]["+i+"]").append("Allow Space"))))
                        //  .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append(get_rate)))
                        .append($j('<td>').addClass("col").append(" ").append($j("<button>").addClass("btn btn-warning btn-xs fas fa-trash enterseq").attr("type","button").attr("id","removeRow").text("")));
                    $j("#detailfield_"+gettitle_id).append(newrow);
                    document.getElementById("no").value="";
                    document.getElementById("description").value="";
                    document.getElementById("detailseq_"+gettitle_id).value = i;

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
                }
            }
            $j("#particularDetailModal").modal('hide');

        })


        function js_add_item(){
            var seq_field = parseInt(document.getElementById("seq_field").value);
            if($j("input[name='description']").val()!=""){
                var editnum = $j(".editnum").html().trim();
                if(isNaN(parseInt(editnum,10))) {

                    seq_field = seq_field + 1;
                    document.getElementById("seq_field").value = seq_field;
                    if($j("input[name='specialfield']").is(":checked") == true ){
                        var txt_color = "style='color:red;'";
                        var special_field = 1;
                        var checked = "checked";
                    } else {
                        var txt_color = "";
                        var special_field = 0;
                        var checked = "";
                    }

                    if($j("input[name='spacefield']").is(":checked") == true ){
                        var spacefield = 1;
                        var space_field = 'style="margin-left:80px;"';
                        var scheck = 'checked';
                    } else {
                        var spacefield = 0;
                        var space_field = '';
                        var schedk = '';
                    }
                    if($j("input[name='input_flag").is(":checked") == true){
                        var input_flag = 1;
                        var icheck = 'checked';
                    } else {
                        var input_flag = 0;
                        var icheck = '';
                    }
                    var nseq = $j("input[name='stockid[]']").length+1;
                    var newrow = $j('<tr>').addClass("d-flex").attr("id","inputFormRow")
                        .append($j('<td>').attr("scope","col").addClass("col-sm-1").append($j("<input>").attr("class","form-control enterseq").attr("name","no["+seq_field+"]").attr("type","text").val($j("input[name='no']").val())))
                        .append($j('<p>').append($j("<input>").attr("name","d_id["+seq_field+"]").attr("type","hidden").val(0)).append($j("<input>").attr("name","detid[]").attr("type","hidden").val($j("input[name='en_detid']").val())).append($j("<input>").attr("name","stockid[]").attr("type","hidden").val($j("input[name='en_stockid']").val())) )
                        .append($j('<td>').addClass("col-sm-6").append($j("<input>").attr("class","form-control enterseq").attr("name","d_description["+seq_field+"]").attr("type","text").val($j("input[name='description']").val())))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_specialfield["+seq_field+"]").attr("type","hidden").val(special_field)).append($j("<div>").attr("class","custom-control custom-switch enterseq").append($j("<input "+checked+">").attr("type","checkbox").attr("class","custom-control-input").attr("id","d_specialfields["+seq_field+"]").attr("name","d_specialfields["+seq_field+"]")).append($j("<label>").attr("class","custom-control-label").attr("for","d_specialfields["+seq_field+"]").append("Red color"))))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_input_flag["+seq_field+"]").attr("type","hidden").val(input_flag)).append($j("<div>").attr("class","custom-control custom-switch enterseq").append($j("<input "+icheck+">").attr("type","checkbox").attr("class","custom-control-input").attr("id","d_input_flag["+seq_field+"]").attr("name","d_input_flags["+seq_field+"]")).append($j("<label>").attr("class","custom-control-label").attr("for","d_input_flags["+seq_field+"]").append("Input"))))
                        .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_spacefield["+seq_field+"]").attr("type","hidden").val(spacefield)).append($j("<div>").attr("class","custom-control custom-switch enterseq").append($j("<input "+scheck+">").attr("type","checkbox").attr("class","custom-control-input").attr("id","d_spacefields["+seq_field+"]").attr("name","d_spacefields["+seq_field+"]")).append($j("<label>").attr("class","custom-control-label").attr("for","d_spacefields["+seq_field+"]").append("Allow Space"))))
                        //  .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append(get_rate)))
                        .append($j('<td>').addClass("col").append($j("<button>").addClass("btn btn-info btn-xs fas fa-plus enterseq").attr("type","button").attr("title","Add Detail").attr("onclick", "add_detail("+seq_field+")").attr("id","addDetail_"+seq_field+"").text("")).append(" ").append($j("<button>").addClass("btn btn-warning btn-xs fas fa-trash enterseq").attr("type","button").attr("id","removeRow").text("")));
                    $j("#bodyitem").append($j("<div id='detailfield_"+seq_field+"'>").append(newrow)).append($j("<input id=\"detailseq_"+seq_field+"\" name=\"stockidx[]\" type=\"hidden\" value=\"0\" >"));
                    document.getElementById("no").value="";
                    document.getElementById("description").value="";
                    document.getElementById("specialfield").checked = false;
                    document.getElementById("spacefield").checked = false;
                    document.getElementById("input_flag").checked = false;
                    $j("input[type='text']").filter("[seq='3']").select();

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
                } else {
                    $j("input[name='detid[]']").eq((editnum-1)).val($j("input[name='en_detid']").val());
                    $j("input[name='d_description[]']").eq((editnum-1)).val($j("input[name='description']").val());
                    document.getElementById("specialfield").checked = false;
                    document.getElementById("input_flag").checked = false;
                    document.getElementById("description").value="";
                    document.getElementById("no").value="";
                    $j("input[type='text']").filter("[seq='3']").select();
                }

            } else {
                alert("Particular is compulsory data!")

                $j("input[type='text']").filter("[seq='3']").select();
            }
            return false;
        }

        function js_add_item2(){
            var seq_field2 = parseInt(document.getElementById("seq_field2").value);
            if($j("input[name='description_detail']").val()!=""){
                var editnum2 = $j(".editnum2").html().trim();
                if(isNaN(parseInt(editnum2,10))) {
                    seq_field2 = seq_field2 + 1;
                    document.getElementById("seq_field2").value = seq_field2;
                    if($j("input[name='specialfield_detail']").is(":checked") == true ){
                        var txt_color = "style='color:red;'";
                        var specialfield = 1;
                    } else {
                        var txt_color = "";
                        var specialfield = 0;
                    }
                    if($j("input[name='spacefield_detail']").is(":checked") == true ){

                        var d_space_field_detail = 1;
                    } else {

                        var d_space_field_detail = 0;
                    }

                    if($j("input[name='detail_input_flag']").is(":checked") == true ){
                        var d_detail_input_flag = 1;

                    } else {
                        var d_detail_input_flag = 0;
                    }
                    var nseq2 = $j("input[name='stockid2[]']").length+1;
                    var newrow2 = $j('<tr>').addClass("d-flex").attr("id","inputFormRow2")
                        .append($j('<td>').attr("scope","col").addClass("col-sm-1").append($j("<input>").attr("name","no["+seq_field+"]").attr("type","hidden").val($j("input[name='no']").val())).append($j("<p>").append($j("input[name='no']").val())))
                        .append($j('<p>').append($j("<input>").attr("name","detid2[]").attr("type","hidden").val($j("input[name='en_detid2']").val())).append($j("<input>").attr("name","stockid2[]").attr("type","hidden").val($j("input[name='en_stockid2']").val())) )
                        .append($j('<td>').addClass("col-sm-7").append($j("<input>").attr("name","d_description_detail["+seq_field2+"]").attr("id","d_description_detail_lgt").attr("type","hidden").val($j("input[name='description_detail']").val())).append( $j("<p "+txt_color+">").append($j("input[name='description_detail']").val())).append($j("<div id='detailfield2_"+seq_field+"'>")))
                        .append($j('<td>').addClass("col-sm-1")).append($j("<input>").attr("name","d_detail_input_flag["+seq_field2+"]").attr("type","hidden").val(d_detail_input_flag)).append($j("<input>").attr("name","d_detail_input_flag["+seq_field2+"]").attr("type","hidden").val(d_detail_input_flag))
                        .append($j('<td>').addClass("col-sm-1")).append($j("<input>").attr("name","d_special_field_detail["+seq_field2+"]").attr("type","hidden").val(specialfield))
                        //  .append($j('<td>').addClass("col-sm-1").append($j("<input>").attr("name","d_rate[]").attr("type","hidden").val($j("input[name='rate']").val())).append( $j("<span>").append(get_rate)))
                        .append($j('<td>').addClass("col").append($j("<button>").addClass("btn btn-warning btn-xs fas fa-trash").attr("type","button").attr("id","removeRow2").text("")));
                    $j("#detailbody").append(newrow2);

                    document.getElementById("description_detail").value="";
                    document.getElementById("specialfield_detail").checked = false;
                    document.getElementById("spacefield_detail").checked = false;
                    document.getElementById("detail_input_flag").checked = false;
                    $j("input[type='text']").filter("[seq='101']").select();
                } else {
                    $j("input[name='detid2[]']").eq((editnum2-1)).val($j("input[name='en_detid2']").val());
                    $j("input[name='d_description_detail[]']").eq((editnum2-1)).val($j("input[name='description_detail']").val());

                    document.getElementById("description_detail").value="";
                    document.getElementById("specialfield_detail").checked = false;
                    document.getElementById("spacefield_detail").checked = false;
                    document.getElementById("detail_input_flag").checked = false;
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
        function js_delitem(num){
            $j("#bodyitem").find("tr").eq((num-1)).remove();
            $j("#bodyitem tr").each(function(i){
                $j(this).find("td").eq(0).html((i+1));
                $j(this).find("a").eq(1).attr("href","javascript:js_delitem('"+(i+1)+"');void(0);");
            })
        }
    </script>
@endsection

@section('topbar')

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

    </form>

@endsection

