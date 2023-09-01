@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Page Heading Start-->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>
        <!-- Page Heading End-->
        @include('partials.messages')

        <form id="userform" method="post" action="{{ url('users') }}" >
            <div class="row form-group">
                <div class="col-3">
                    {{ csrf_field() }}
                    <label for="name">Name:</label>
                    <input type="text" seq="1" class="form-control enterseq" id="name" name="name" maxlength="100"  value="{{ old('name') }}" />
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="email">Email:</label>
                    <input type="text" seq="2" class="form-control enterseq" name="email" maxlength="100"  value="{{ old('email') }}" />
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="rolesid">Roles:</label>
                    <select class="form-control enterseq" seq="3" name="rolesid">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["roles"] as $rroles)
                            <option value="{{ $rroles['id']}}" @if (old('rolesid') == $rroles['id']) selected @endif>
                                {{ $rroles['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('rolesid') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="rolesid">Staff ID:</label>
                    <select class="form-control enterseq" seq="4" name="staff_id">
                        <option value=""> -- Selection --</option>
                        @foreach ($data["staff"] as $rstaff)
                            <option value="{{ $rstaff['id']}}" @if (old('staff_id') == $rstaff['id']) selected @endif>
                                {{ $rstaff['name'] }} ({{ $rstaff['staffcode'] }})
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('staff_id') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="password">Password:</label>
                    <input type="password" seq="5" class="form-control enterseq" name="password" maxlength="100"  value="{{ old('password') }}"/>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="password-confirm">Confirm Password</label>
                    <input type="password" id="password-confirm" seq="6" class="form-control enterseq" name="password_confirmation" maxlength="100" value="{{ old('password_confirmation') }}" />
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\UsersController@index') }}" class="btn btn-secondary btn-xs">Back</a> <button type="submit" seq="7" class="btn btn-primary enterseq">Create</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        if ($("#userform").length > 0) {
            $("#userform").validate({
                rules: {
                    email: {
                        email: true,
                        maxlength: 100
                    },
                    name: {
                        required: true,
                        maxlength:100
                    },
                    rolesid:{
                        required: true
                    },
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        maxlength: "Your email maxlength should be 20 characters long.",
                        email: "Invalid email"
                    },
                    name: {
                        required: "Please enter name",
                        maxlength: "The name should be 200 characters long"
                    },
                    rolesid:{
                        required:"Please select user roles"
                    },
                    password: {
                        required: "Please enter password",
                    },
                    password_confirmation: {
                        required: "Please enter confirm password",
                    }
                },
            })
            $("#userform").submit(function(evt){
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
