@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Term</h1>
        </div>
        <!-- Page Heading End -->

        @include('partials/messages')

        <form id="termform" method="post" action="{{ action('App\Http\Controllers\TermsController@update', $term->id) }}">
            @csrf
            @method('PATCH')

            <div class="row form-group">
                <div class="col-6">
                    <label for="title">Term:</label>
                    <input type="text" seq="1" class="form-control enterseq" name="term" value="{{$term->term}}" maxlength="20" />
                    <span class="text-danger">{{ $errors->first('term') }}</span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-6">
                    <label for="title">Description:</label>
                    <input type="text" seq="2" class="form-control enterseq" name="description" value="{{$term->description}}" maxlength="200" />
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Term Days:</label>
                    <input type="text" seq="3" class="form-control enterseq" name="termdays" value="{{$term->termdays}}" maxlength="11"/>
                    <span class="text-danger">{{ $errors->first('termdays') }}</span>
                </div>
            </div>

            <a href="{{ action('App\Http\Controllers\TermsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
            <button type="submit" seq="4" class="btn btn-primary enterseq">Update</button>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#termform").length > 0) {
            $j("#termform").validate({
                rules: {
                    term: {
                        required: true,
                        maxlength: 20
                    },
                    description: {
                        required: true,
                        maxlength:200
                    },
                    termdays: {
                        required: true,
                        maxlength:11,
                        number: true
                    }
                },
                messages: {
                    term: {
                        required: "Please enter term",
                        maxlength: "Your term maxlength should be 20 characters long."
                    },
                    description: {
                        required: "Please enter description",
                        maxlength: "The description should be 200 characters long"
                    },
                    termdays: {
                        required: "Please enter term days",
                        maxlength: "Term days should be 11 digits number long.",
                        number: "Invalid input value!! Number only"
                    }
                },
            })
            $j("#termform").submit(function(evt){
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
