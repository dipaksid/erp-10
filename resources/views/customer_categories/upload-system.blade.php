@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Category (Upload System File)</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="categoryform" method="post" action="{{action('App\Http\Controllers\CustomerCategoriesController@uploadsystemfile', $id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row form-group">
                    <div class="col-6">
                        <label for="categorycode">Category Code:</label>
                        <input type="text" class="form-control" name="categorycode" value="{{$category->categorycode}}" readOnly="readOnly"/>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{$category->description}}" readOnly="readOnly" />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="last_version">Latest System Version:</label>
                        <input type="text" class="form-control" name="last_version" value="{{$category->version}}" readOnly="readOnly"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="version">Today System Version:</label>
                        <input type="text" class="form-control" name="version" value="{{$system_version}}" readOnly="readOnly"/>
                    </div>
                </div>
                @if($category->b_mobapp=="Y")
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="appfile">App Installation File: {{ $category->b_mobapp }}</label>
                            <input type="file" seq="1" class="form-control enterseq" name="appfile"/>
                            <span class="text-danger">{{ $errors->first('appfile') }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="version_desc">Version Description:</label>
                            <input type="text" seq="2" maxlength="191" class="form-control enterseq" name="version_desc"/>
                            <span class="text-danger">{{ $errors->first('version_desc') }}</span>
                        </div>
                    </div>
                @else
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="systemfile56">System File 5.6:</label>
                            <input type="file" seq="1" class="form-control enterseq" name="systemfile56"/>
                            <span class="text-danger">{{ $errors->first('systemfile56') }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="systemfile">System File 5.2:</label>
                            <input type="file" seq="2" class="form-control enterseq" name="systemfile"/>
                            <span class="text-danger">{{ $errors->first('systemfile') }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="sqlfile">SQL File:</label>
                            <input type="file" seq="3" class="form-control enterseq" name="sqlfile"/>
                            <span class="text-danger">{{ $errors->first('sqlfile') }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="version_desc">Version Description:</label>
                            <input type="text" seq="4" maxlength="191" class="form-control enterseq" name="version_desc"  value="{{ old('version_desc') }}" />
                            <span class="text-danger">{{ $errors->first('version_desc') }}</span>
                        </div>
                    </div>
                @endif
                <a href="{{ action('App\Http\Controllers\CustomerCategoriesController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a> <button type="submit" seq="5" class="btn btn-primary enterseq">Upload</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#categoryform").length > 0) {
            $j("#categoryform").validate({
                rules: {
                    categorycode: {
                        required: true,
                        maxlength: 20
                    },
                    description: {
                        required: true,
                        maxlength:200
                    }
                },
                messages: {
                    categorycode: {
                        required: "Please enter category code",
                        maxlength: "Your category code maxlength should be 20 characters long."
                    },
                    description: {
                        required: "Please enter description",
                        maxlength: "The description should be 200 characters long"
                    }
                },
            })
            $j("#categoryform").submit(function(evt){
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
