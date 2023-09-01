@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start-->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Area</h1>
            </div>
            <!-- Page Heading END-->

            @include('partials/messages')

            <form id="areaform" method="post" action="{{ url('areas') }}" >
                @csrf

                <div class="row form-group">
                    <div class="col-6">
                        <label for="areacode">Area Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="areacode" name="areacode" maxlength="2" value="{{ old('areacode') }}" />
                        <span class="text-danger">{{ $errors->first('areacode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Description:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="description" maxlength="200" value="{{ old('description') }}" />
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isactive" name="isactive">
                            <label class="custom-control-label" for="isactive"></label>
                        </div>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\AreasController@index') }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="3" class="btn btn-primary enterseq">Create</button>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#areaform").length > 0) {
            $j("#areaform").validate({
                rules: {
                    areacode: {
                        required: true,
                        maxlength: 2
                    },

                    description: {
                        required: true,
                        maxlength:200,
                    }
                },
                messages: {
                    areacode: {
                        required: "Please enter area code",
                        maxlength: "Your area code maxlength should be 2 characters long.",
                        normalizer: function(value) {
                            return $j.trim(value);
                        }
                    },
                    description: {
                        required: "Please enter description",
                        maxlength: "The description should be 200 characters long",
                    },
                },
            })
            $j("#areaform").submit(function(evt){
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
