@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start-->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Agents</h1>
            </div>
            <!-- Page Heading End-->

            @include('partials/messages')

            <form id="agentform" method="post" action="{{ url('agents') }}" >
                @csrf

                <div class="row form-group">
                    <div class="col-3">
                        <label for="agentcode">Agent Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="agentcode" name="agentcode" maxlength="10"  value="{{ old('agentcode') }}" />
                        <span class="text-danger">{{ $errors->first('agentcode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Name:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="name" maxlength="60" value="{{ old('name') }}"/>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Area:</label>
                        <select class="form-control enterseq" seq="3" name="areas_id">
                            <option value=""> -- Selection --</option>
                            @foreach ($data["area"] as $id => $rarea)
                                <option value="{{ $id }}" {{ old('areas_id') == $id ? 'selected' : '' }}>{{ $rarea }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Commission Rate:</label>
                        <input type="text" class="form-control enterseq" seq="4" name="commrate" maxlength="8" value="{{ old('commrate') }}"/>
                    </div>
                </div>
                <a href="{{ action('App\Http\Controllers\AgentsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="5" class="btn btn-primary enterseq">Create</button>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#agentform").length > 0) {
            $j("#agentform").validate({
                rules: {
                    agentcode: {
                        required: true,
                        maxlength: 10
                    },
                    name: {
                        required: true,
                        maxlength:60
                    },
                    areas_id: {
                        required: true
                    },
                    commrate: {
                        required: true,
                        maxlength:8
                    }
                },
                messages: {
                    agentcode: {
                        required: "Please enter agent code",
                        maxlength: "Your bank code maxlength should be 10 characters long."
                    },
                    name: {
                        required: "Please enter name",
                        maxlength: "The name should be 60 characters long"
                    },
                    areas_id: {
                        required: "Please enter area"
                    },
                    commrate: {
                        required: "Please enter commission rate",
                        maxlength: "The name should be 8 characters long"
                    }
                },
            })
            $j("#agentform").submit(function(evt){
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
