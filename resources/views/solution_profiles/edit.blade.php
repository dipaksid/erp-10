@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Solution Profile</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="solutionform" method="post" action="{{action('App\Http\Controllers\SolutionProfilesController@update', $solutionprofile->id."?searchvalue=".$request['searchvalue']."&page=".$request['page'])}}&tab={{((isset($request['tab']))?$request['tab']:'solutionprofile-tab')}}" >
                @csrf
                @method('PATCH')

                <div class="row form-group">
                    <div class="col-6">
                        <label for="areacode">Solution Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="solutioncode" value="{{$solutionprofile->solutioncode}}" name="solutioncode" placeholder="AUTO-GENERATE" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('solutioncode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Problem Description:</label>

                        <textarea class="form-control enterseq" name="problem_description" id="problem_description" seq="2"  rows="20" cols="100">{{$solutionprofile->problem_description}}</textarea>
                        <span class="text-danger">{{ $errors->first('[problem_description') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Problem Solution:</label>
                        <textarea class="form-control enterseq" name="problem_solution" id="modal_note" seq="3"  rows="20" cols="100">{{$solutionprofile->problem_solution}}</textarea>
                        <span class="text-danger">{{ $errors->first('[problem_solution') }}</span>
                    </div>
                </div>

                @if($solutionprofile->active == 2)
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="title">Active:</label>
                            <select id="active" name="active" class="form-control  enterseq" seq="4">
                                <option {{(($solutionprofile->active=='1')?"selected":"")}} value="1" >Active</option>
                                <option {{(($solutionprofile->active=='2')?"selected":"")}} value="2" >Pending</option>
                                <option {{(($solutionprofile->active=='0')?"selected":"")}} value="0" >Inactive</option>
                            </select>

                        </div>
                    </div>
                @else
                    <div class="row form-group">
                        <div class="col-3">
                            <label for="title">Active:</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input enterseq" seq="4" id="active" {{(($solutionprofile->active=='1')?"checked":"")}}  name="active">
                                <label class="custom-control-label" for="active"></label>
                            </div>
                        </div>
                    </div>
                @endif

                <div id="duplic_problem_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="profile-completeness-modal" aria-hidden="true" data-keyboard="true" data-backdrop="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="noteModalLabel">Open Back case?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row form-group">
                                    <div class="col-12">
                                        There are similar problem description found. Are you sure want to save?
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger enterseq" data-dismiss="modal" aria-label="Close">
                                    Close
                                </button>
                                <button type="button" id="confirm_save" class="btn btn-primary enterseq" seq="42" >Confirm</button>
                                <input type="hidden"  class="btn btn-primary enterseq" seq="43" >
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="active_flag" value="{{$solutionprofile->active}}" />
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="button" id="check_update" seq="5" class="btn btn-primary enterseq">Update</button>
                <button type="submit" id="submit_form"  style="display:none;" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        var ck = CKEDITOR.replace('problem_solution');
        var ck2 = CKEDITOR.replace('problem_description');
        var $j = jQuery.noConflict();
        if ($j("#solutionform").length > 0) {
            $j("#solutionform").validate({
                rules: {
                    solutioncode: {
                        //  required: true,
                        maxlength: 10
                    },

                    problem_description: {
                        required: true,
                        maxlength:100,
                    },

                    problem_solution: {
                        required: true,
                        maxlength:250,
                    }
                },
                messages: {

                    problem_description: {
                        required: "Please enter description",
                        maxlength: "The description should be 250 characters long",
                    },
                },
            })
            $j("#solutionform").submit(function(evt){
                $j("input[type='text']").each(function(i){
                    $j(this).val($j(this).val().toUpperCase());
                })
            })
        }

        $j('#check_update').click(function() {
            var active_flag = document.getElementById("active_flag").value;
            if(active_flag == 1){
                $j("#submit_form").click();
            } else {
                var getid = "{{$solutionprofile->id}}";
                var problems = CKEDITOR.instances['problem_description'].getData();
                $j.ajax({
                    url: '{{URL::to('checkduplicate_problem')}}',
                    type:'get',
                    data:{id:getid,problem_description:problems},
                    success: function(data){
                        if(data == 1){
                            //duplicate
                            $j("#duplic_problem_modal").modal("show");
                        } else {
                            $j("#submit_form").click();
                        }
                    }
                })
            }
        });
        $j("#confirm_save").click(function(){
            $j("#submit_form").click();
        });
        $j(document).ready(function(evt){
            $j(".enterseq").each(function(i){
                $j(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($j(this).is("input")) {
                                $j(this).val($j(this).val().toUpperCase());
                                if($j(this).is("input[id='solutioncode']")) {
                                    ck2.focus();
                                }
                                if($j(this).is("input[id='problem_description']")) {
                                    var check_desc = document.getElementById("problem_description").value;
                                    ck.focus();
                                    if(check_desc == ''){
                                        alert("Please Key In Problem Description");
                                        $j("input[type='text']").filter("[seq='2']").select();
                                    }
                                }
                            } else if($j(this).is("button[id='check_update']")) {
                                $j("#check_update").trigger("click");
                            }  else if($j(this).is("select")) {
                                if($j(this).is("select[name='active']")){

                                    $j("input[type='text']").filter("[seq='4']").focus();
                                }
                            } else if($j(this).is("button[type='submit']")) {
                                $j(this).click();
                                return false;
                            }
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
        })
    </script>
@endsection
