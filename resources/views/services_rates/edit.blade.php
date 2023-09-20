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
                <h1 class="h3 mb-0 text-gray-800">Service Rate Profile</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="servicerateform" method="post" action="{{ action('App\Http\Controllers\ServiceRatesController@update', $services_rate->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="printdo">
                <input type="hidden" name="salesnote">
                <input type="hidden" name="printnote">
                <input type="hidden" name="salesnotelist">

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Effective Date:</label>
                        <input type="text" seq="1" class="form-control enterseq" value="{{ date('d/m/Y',strtotime($services_rate->effectivedate)) }}" name="effectivedate" id="effectivedate" maxlength="10"/>
                    </div>
                </div>

                <table class="table">
                    <thead class="thead-light">
                    <tr class="d-flex">
                        <th class="col-sm-8"><input type='text' name='description' id="description" seq="2" class="form-control enterseq"></th>
                        <th class="col-sm-2"><input type='text' name='rate' seq="3" id="rate" class="form-control enterseq"></th>
                        <th class="col-sm-1"><input type='hidden' name="en_amount" class="form-control text-right readonly" readOnly></th>
                        <th class="col-sm-1"><input type='hidden' name="en_netamount" class="form-control text-right readonly" readOnly></th>
                        <th scope="col" class="editnum"></th>
                        <th class="col canceledit"> </th>
                    </tr>
                    <tr class="d-flex">
                        <th class="col-sm-8">Service Description</th>
                        <th class="col-sm-2">Rate/Trip</th>
                        <th class="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="bodyitem">
                        @php
                            $get_effective = json_decode($services_rate->description);
                            $num=0;
                        @endphp
                        @if(is_array($get_effective) && count($variable) > 0)
                            @foreach($get_effective as $key => $value)
                                @php $num++; @endphp
                                <tr class="d-flex" id="inputFormRow">
                                    <td class="col-sm-8">{{ $get_effective->count() }}<input type="text" class="form-control enterseq" name="d_description[]" value="{{ $value->description ?? 'NA' }}" ></td>
                                    <td class="col-sm-2"><input type="text" class="form-control enterseq" name="d_rate[]" value="{{  (isset($value->rate)) ?  number_format((float) $value->rate, 2) : 0 }}" ></td>
                                    <td class="col-sm-2"><button type="button" class="btn btn-warning btn-xs fas fa-trash" id="removeRow"></button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="d-flex" id="inputFormRow">
                                <td class="col-sm-8"><input type="text" class="form-control enterseq" name="d_description[]" value=" {{ $get_effective->description ?? 'NA' }}"></td>
                                <td class="col-sm-2"><input type="text" class="form-control enterseq" name="d_rate[]" value="{{ $get_effective->rate ?? 0 }}"></td>
                                <td class="col-sm-2"><button type="button" class="btn btn-warning btn-xs fas fa-trash" id="removeRow"></button></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <a href="{{ action('App\Http\Controllers\ServiceRatesController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
                <button type="submit" seq="16" class="btn btn-primary enterseq" id="btnAction">Update</button>
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
            <!-- -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('js/base.js') }}"></script>
    <script>
        flatpickr("input[name=effectivedate]", { dateFormat: 'd/m/Y' });
    </script>
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
        $j(document).on('click', '#removeRow', function () {
            $j(this).closest('#inputFormRow').remove();
        });
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
                    if(keycode==13){

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
            // $j("input[name='effectivedate']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
            //     $j(this).datepicker('hide');
            // });
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







        })


        function js_add_item(){
            if($j("input[name='description']").val()!="" && $j("input[name='rate']").val()>0){
                var editnum = $j(".editnum").html().trim();
                var r = $j("input[name='rate']").val();
                var get_rate = parseInt(r).toFixed(2);

                var nseq = $j("input[name='stockid[]']").length+1;

                var newrow = $j('<tr>').addClass("row").attr("id","inputFormRow")
                    .append($j('<td>').addClass("col-sm-8").append($j("<input>").attr("name","d_description[]").attr("class",'form-control enterseq').attr("type","text").val($j("input[name='description']").val())))
                    .append($j('<td>').addClass("col-sm-2").append($j("<input>").attr("name","d_rate[]").attr("class",'form-control enterseq').attr("type","text").val(get_rate)))
                    .append($j('<td>').addClass("col").append($j("<button>").addClass("btn btn-warning btn-xs fas fa-trash").attr("type","button").attr("id","removeRow").text("")));
                $j("#bodyitem").append(newrow);
                document.getElementById("description").value="";
                document.getElementById("rate").value="";
                $j("input[type='text']").filter("[seq='2']").select();
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
                            if($j(this).attr("name")=="en_qty" || $j(this).attr("name")=="en_unitprice" || $j(this).attr("name")=="en_discount"){
                                if($j(this).attr("name")=="en_qty" && $j(this).val()<=0){
                                    $j(this).select();
                                    return false;
                                }

                            }
                            if($j(this).attr("name")=="rate"){

                                //  $j(".stockAutoSelect").select();
                            }
                            return false;
                        }
                        if(keycode==38){

                        }
                    })
                })


            } else {
                alert("Description and rate/trip is compulsory data!")
                $j(".stockAutoSelect").select();
            }
            return false;
        }
    </script>
@endsection

@section('topbar')

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">

    </form>

@endsection


