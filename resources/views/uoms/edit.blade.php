@extends('layouts.app')

@section('styles')
    <link href="{{ asset('js/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">UOMs</h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <form id="categoryform" method="post" action="{{ action('App\Http\Controllers\UomsController@update', $uom->id) }}" >
                @csrf
                @method('PATCH')

                <div class="row form-group">
                    <div class="col-3">
                        <label for="uomcode">Stock Code:</label>
                            <select class="form-control stockAutoSelect enterseq overflow-ellipsis" seq="1" name="stocks_id"
                                placeholder="Stock search..."
                                autocomplete="off">
                                <option value="">Select a stock</option> <!-- Add an empty option -->
                                @foreach($stocks as $stock)
                                    <option value="{{ $stock['id'] }}" {{ $stock['id'] == $uom['stocks_id'] ? 'selected' : '' }}>
                                        {{ $stock['text'] }}
                                    </option>
                                @endforeach
                            </select>
                        <span class="text-danger">{{ $errors->first('stocks_id') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">UOMs Code:</label>
                        <input type="text" seq="2" class="form-control enterseq" name="uomcode" value="{{$uom->uomcode}}" maxlength="20" />
                        <span class="text-danger">{{ $errors->first('categorycode') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="description">Description:</label>
                        <input type="text" seq="3" class="form-control enterseq" name="description" value="{{$uom->description}}" maxlength="100" />
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="isactive">Active:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isactive" name="isactive" {{(($uom->isactive=='1')?"checked":"")}} >
                            <label class="custom-control-label" for="isactive"></label>
                        </div>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\UomsController@index') }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="3" class="btn btn-primary enterseq">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        if ($j("#categoryform").length > 0) {
            $j("#categoryform").validate({
                rules: {
                    stocks_id: {
                        required: true
                    },
                    uomcode: {
                        required: true,
                        maxlength: 20
                    },
                    description: {
                        maxlength:100
                    }
                },
                messages: {
                    stocks_id: {
                        required: "Please enter Stock code"
                    },
                    uomcode: {
                        required: "Please enter UOMs code",
                        maxlength: "Your email maxlength should be 20 characters long.",
                    },
                    description: {
                        maxlength: "The name should be 100 characters long"
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
            //$j('.stockAutoSelect').autoComplete({minLength:2});
            const stocks = @json($stocks);
            $j('.stockAutoSelect').select2({
                data: stocks,
                placeholder: 'Select a stock',
                allowClear: true, // Adds a clear button
                multiple: false   // Ensures single select behavior
            });

            $j('.stockAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    $j(this).change();
                    return false;
                }
                if(keycode==113){
                    $j("#btnAction").focus();
                    return false;
                }
                if(keycode==116){
                    var modal = $j('#doStocklistModal').modal({
                        backdrop: 'static',
                        keyboard: true
                    });

                    $j('#doStocklistModal').on('hidden.bs.modal', function () {
                        $j("input[name='en_description']").select();
                    })
                    return false;
                }
                if(keycode==38){
                    //$j("input[name='referenceno']").select();
                }
            })
            $j('.stockAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    if($j('.stockAutoSelect').val()==""){
                        $j('.stockAutoSelect').focus();
                    } else {
                        $j("input[name='uomcode']").select();
                    }
                },300);
                return false;
            });
            // $j('.stockAutoSelect').on('blur', function (e, datum) {
            //     $j(this).change();
            //     return false;
            // });
            //$j('.stockAutoSelect').val("{{$uom->uomsstock()->pluck('stockcode')->implode('')}}");
            //$j("input[name='stocks_id']").val("{{$uom->stocks_id}}");
        })
    </script>
@endsection
