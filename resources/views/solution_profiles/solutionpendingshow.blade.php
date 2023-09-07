@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Solution Profile Pending Show</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="solutionform" method="post" action="{{url('solutionprofile/solutionupdatepending')}}" >
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PATCH">
                <div class="row form-group">

                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Problem Description:</label>
                        <textarea class="form-control enterseq" name="complain_problem" id="complain_problem" seq="3"  rows="20" cols="100">{{$solutionpending->complain_problem}}</textarea>
                        <span class="text-danger">{{ $errors->first('[complain_problem') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Problem Solution:</label>
                        <textarea class="form-control enterseq" name="service_solution" id="modal_note" seq="3"  rows="20" cols="100">{{$solutionpending->service_solution}}</textarea>
                        <span class="text-danger">{{ $errors->first('[service_solution') }}</span>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\SolutionProfilesController@index') }}" class="btn btn-secondary btn-xs">Back</a> <button type="submit" seq="4" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        var ck = CKEDITOR.replace('service_solution');
        var ck2 = CKEDITOR.replace('complain_problem');
        var $j = jQuery.noConflict();
        if ($j("#solutionform").length > 0) {
            $j("#solutionform").validate({
                rules: {


                    complain_problem: {
                        required: true,
                        maxlength:100,
                    },

                    service_solution: {
                        required: true,
                        maxlength:250,
                    }
                },
                messages: {

                    complain_problem: {
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
                                if($j(this).is("input[id='complain_problem']")) {
                                    var check_desc = document.getElementById("complain_problem").value;
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
