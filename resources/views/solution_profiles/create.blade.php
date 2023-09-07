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

            <form id="solutionform" method="post" action="{{url('solutionprofile')}}?searchvalue={{((isset($request['searchvalue']))?$request['searchvalue']:'')}}&page={{((isset($request['page']))?$request['page']:'')}}&tab={{((isset($request['tab']))?$request['tab']:'solutionprofile-tab')}}" >
                @csrf

                <div class="row form-group">
                    <div class="col-6">
                        <label for="areacode">Solution Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="solutioncode" name="solutioncode" maxlength="10" placeholder="AUTO-GENERATE" value="{{ old('solutioncode') }}" />
                        <span class="text-danger">{{ $errors->first('solutioncode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Problem Description:</label> <span style="color:red;">*</span>
                        <input type="text" seq="2" class="form-control enterseq" name="problem_description" id="problem_description" maxlength="100" value="{{ old('problem_description') }}" />
                        <span class="text-danger">{{ $errors->first('[problem_description') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Problem Solution:</label>
                        <textarea class="form-control enterseq" name="problem_solution" id="modal_note" seq="3"  rows="20" cols="100">
                            {{ old('problem_solution') }}
                        </textarea>
                        <span class="text-danger">{{ $errors->first('[problem_solution') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" checked name="active" {{ old('active') ? 'checked=true' : '' }}>
                            <label class="custom-control-label" for="active"></label>
                        </div>
                    </div>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="4" class="btn btn-primary enterseq">Create</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        var ck = CKEDITOR.replace('problem_solution');
        if ($j("#solutionform").length > 0) {
            $j("#solutionform").validate({
                rules: {
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
        $j(document).ready(function(evt){
            $j(".enterseq").each(function(i){
                $j(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($j(this).is("input")) {
                                $j(this).val($j(this).val().toUpperCase());
                                if($j(this).is("input[id='problem_description']")) {
                                    var check_desc = document.getElementById("problem_description").value;
                                    ck.focus();
                                    if(check_desc == ''){
                                        alert("Please Key In Problem Description");
                                        $j("input[type='text']").filter("[seq='2']").select();
                                    }
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
