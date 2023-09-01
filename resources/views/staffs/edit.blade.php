@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Staff</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="staffform" method="post" action="{{ action('App\Http\Controllers\StaffsController@update', $staff->id) }}">
                @csrf
                @method('PATCH')

                <div class="row form-group">
                    <div class="col-3">
                        <label for="staffcode">Staff Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" name="staffcode" value="{{$staff->staffcode}}" maxlength="10" />
                        <span class="text-danger">{{ $errors->first('staffcode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Name:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="name" value="{{$staff->name}}" maxlength="60" />
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Company:</label>*
                        <select seq="3" class="form-control enterseq" required id="comp_id" name="comp_id">
                            <option value=""></option>
                            @foreach($comp_setting as $ckey => $crow)
                                <option {{(($crow->id == $staff->comp_id)?"selected":"")}} value="{{$crow->id}}"> {{$crow->companyname}} ({{$crow->companycode}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Designation:</label>
                        <input type="text" seq="4" class="form-control enterseq" name="designation" value="{{$staff->designation}}" maxlength="20"/>
                        <span class="text-danger">{{ $errors->first('designation') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Department:</label>
                        <input type="text" seq="5" class="form-control enterseq" name="department" value="{{$staff->department}}" maxlength="20"/>
                        <span class="text-danger">{{ $errors->first('department') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Date Joined:</label>
                        <input type="text" seq="6" class="form-control enterseq" name="date_join" value="{{$staff->date_join}}" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('date_join') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="title">Last Review:</label>
                        <input type="text" seq="11" readonly class="form-control enterseq" name="last_review" value="{{$staff->last_review}}" maxlength="10"/>
                        <span class="text-danger">{{ $errors->first('last_review') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Commission Rate:</label>
                        <input type="text" class="form-control enterseq" seq="7" name="commrate" value="{{$staff->commrate}}" maxlength="8" />
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\StaffsController@index') }}" class="btn btn-secondary btn-xs">Back</a> <button type="submit" seq="8" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        flatpickr("input[name=date_join]", { dateFormat: 'd/m/Y' });
    </script>
    <script type="text/javascript">
        if ($j("#staffform").length > 0) {
            $j("#staffform").validate({
                rules: {
                    staffcode: {
                        required: true,
                        maxlength: 10
                    },
                    name: {
                        required: true,
                        maxlength:60
                    },
                    commrate: {
                        required: true,
                        maxlength:8
                    }
                },
                messages: {
                    staffcode: {
                        required: "Please enter staff code",
                        maxlength: "Your bank code maxlength should be 10 characters long."
                    },
                    name: {
                        required: "Please enter name",
                        maxlength: "The name should be 60 characters long"
                    },
                    commrate: {
                        required: "Please enter commission rate",
                        maxlength: "The name should be 8 characters long"
                    }
                },
            })
            $j("#staffform").submit(function(evt){
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
                            if($j(this).attr("name")=="date_join"){
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

            $j("input[name='date_join']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(e){
                $j(this).datepicker('hide');
            });


            $j("input[name='date_join']").keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                switch(keycode) {
                    case 13:
                        $j("#commrate").focus();
                        return false;
                        break;
                }
            })
        })
    </script>
@endsection
