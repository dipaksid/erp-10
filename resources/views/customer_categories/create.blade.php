@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Category</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="categoryform" method="post" action="{{ url('customercategory') }}" >
                @csrf

                <div class="row form-group">
                    <div class="col-3">
                        <label for="categorycode">Category Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="categorycode" name="categorycode" maxlength="20" value="{{ old('categorycode') }}" />
                        <span class="text-danger">{{ $errors->first('categorycode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Description:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="description" maxlength="200" value="{{ old('description') }}" />
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Last Running Serial Number:</label>
                        <input type="text" seq="3" class="form-control enterseq" name="lastrunno" maxlength="10" value="{{ old('lastrunno') }}" />
                        <span class="text-danger">{{ $errors->first('lastrunno') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="b_rmk">Allow Remark [Y/N]:</label>
                        <input type="text" seq="4" class="form-control enterseq" name="b_rmk" value="N" maxlength="1" value="{{ old('b_rmk') }}" />
                        <span class="text-danger">{{ $errors->first('b_rmk') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="b_mobapp">Mobile Application [Y/N]:</label>
                        <input type="text" seq="5" class="form-control enterseq" name="b_mobapp" value="N" maxlength="1" value="{{ old('b_mobapp') }}" />
                        <span class="text-danger">{{ $errors->first('b_mobapp') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="b_adrmk">Allow Print Remark On Sales @adrmk [Y/N]:</label>
                        <input type="text" seq="6" class="form-control enterseq" name="b_adrmk" value="N" maxlength="1" value="{{ old('b_adrmk') }}" />
                        <span class="text-danger">{{ $errors->first('b_adrmk') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="stockcatgid">Stock Category:</label>
                        <select class="form-control enterseq" seq="7" name="stockcatgid">
                            <option value=""> -- Selection --</option>
                            @foreach ($stockCategories as $id => $description)
                                <option value="{{ $id }}" {{ old('stockcatgid') == $id ? 'selected' : '' }}>
                                    {{ $description }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('stockcatgid') }}</span>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\CustomerCategoriesController@index') }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="8" class="btn btn-primary enterseq">Create</button>
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
                    },
                    lastrunno: {
                        required: true,
                        maxlength: 20
                    },
                    b_rmk: {
                        required: true,
                        maxlength: 1
                    },
                    b_mobapp: {
                        required: true,
                        maxlength: 1
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
                    } ,
                    lastrunno: {
                        required: "Please enter Last Running Serial Number",
                        maxlength: "The description should be 20 characters long"
                    } ,
                    b_rmk: {
                        required: "Please enter Allow Remark [Y/N]",
                        maxlength: "The description should be 1 characters long"
                    },
                    b_mobapp: {
                        required: "Please enter Mobile Application [Y/N]",
                        maxlength: "The description should be 1 characters long"
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
