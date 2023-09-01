@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">
                Roles
            </h1>
        </div>
        <!-- Page Heading End -->
        @include('partials/messages')
        <form id="roleform" method="post" action="{{ url('roles') }}" >
            @csrf
            <div class="row form-group">
                <div class="col-3">
                    <label for="name">Name:</label>
                    <input type="text" seq="1" class="form-control enterseq" id="name" name="name" maxlength="100"/>
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <!-- Checkboxes -->
                    <label for="permissions">Permission:</label>
                    <div class="row">
                        <!-- Custom error placement div -->
                        <div id="row permissions-error" class="error"><label id="permissions[]-error" class="error" for="permissions[]"></label></div>
                        @foreach ($permissions as $id => $name)
                            <div class="col-3">
                                <input type="checkbox" name="permissions[]" value="{{ $id }}"/> {{ $name }}
                            </div>
                        @endforeach
                        <br>
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    </div>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\RolesController@index') }}" class="btn btn-secondary btn-xs">Back</a> <button type="submit" seq="6" class="btn btn-primary enterseq">Create</button>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        if ($("#roleform").length > 0) {
            $("#roleform").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength:100
                    },
                    "permissions[]":{
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        maxlength: "The name should be 100 characters long"
                    },
                    "permissions[]":{
                        required:"Please check permissions"
                    }
                },
            })
            $("#roleform").submit(function(evt){
                $("input[type='text']").each(function(i){
                    $(this).val($(this).val().toUpperCase());
                })
            })
        }
        $(document).ready(function(evt){
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
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                    $("select").filter("[seq='"+dd+"']").focus();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("checkbox")){
                                    $("checkbox").filter("[seq='"+dd+"']").select();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("input[type='password']")){
                                    $("input[type='password']").filter("[seq='"+dd+"']").select();
                                } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                    $("button").filter("[seq='"+dd+"']").focus();
                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($(this).attr("seq"),10)>0)?(parseInt($(this).attr("seq"),10)-1):parseInt($(this).attr("seq"),10);
                            if($("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                $("input[type='text']").filter("[seq='"+dd+"']").select();;
                            } else if($("select").filter("[seq='"+dd+"']").length>0){
                                $("select").filter("[seq='"+dd+"']").focus();;
                            } else if($("input[type='password']").filter("[seq='"+dd+"']").length>0){
                                $("input[type='password']").filter("[seq='"+dd+"']").focus();;
                            }
                    }
                    if(keycode==13)
                        return false;
                })
            })
            if($(".enterseq").filter("[seq='1']").is("input")) {
                $("input[type='text']").filter("[seq='1']").select();
            } else if($(".enterseq").filter("[seq='1']").is("select")){
                $("select").filter("[seq='1']").focus();
            } else if($(".enterseq").filter("[seq='1']").is("checkbox")){
                $("checkbox").filter("[seq='1']").select();
            } else if($(".enterseq").filter("[seq='1']").is("button")){
                $("button").filter("[seq='1']").focus();
            }
        })
    </script>
@endsection
