@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Bank</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="bankform" method="post" action="{{url('banks')}}">
                @csrf

                <div class="row form-group">
                    <div class="col-3">
                        <label for="code">Bank Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="code" name="code" maxlength="20" value="{{ old('code') }}"/>
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Name:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="name" maxlength="200" value="{{ old('name') }}" />
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\BanksController@index') }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="3" class="btn btn-primary enterseq">Create</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#bankform").length > 0) {
            $j("#bankform").validate({
                rules: {
                    code: {
                        required: true,
                        maxlength: 20
                    },
                    name: {
                        required: true,
                        maxlength:200
                    }
                },
                messages: {
                    code: {
                        required: "Please enter bank code",
                        maxlength: "Your bank code maxlength should be 20 characters long."
                    },
                    name: {
                        required: "Please enter name",
                        maxlength: "The name should be 200 characters long"
                    }
                },
            })
            $j("#bankform").submit(function(evt){
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
