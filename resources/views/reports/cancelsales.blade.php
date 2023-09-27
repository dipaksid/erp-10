@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cancel Sales Report</h1>
        </div>
        <!-- Page Heading End -->

        <div>
            @include('partials/messages')

            <form id="reportform" method="post" action="{{ url('report/cancelsales') }}" target="_blank">
                @csrf

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Cancel Date From:</label>
                        <input type="text" class="form-control enterseq" placeholder="dd/mm/yyyy" name="datfr" seq="1"
                               value="{{ (isset($data['logindate'])) ? $data['logindate']:'' }}"/>
                    </div>
                    <div class="col-3">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Cancel Date To:</label>
                        <input type="text" class="form-control enterseq" placeholder="dd/mm/yyyy" name="datto" seq="2"
                               value="{{ (isset($data['logindate'])) ? $data['logindate']:'' }}"/>
                    </div>
                    <div class="col-3">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Area:</label>
                        <select class="form-control enterseq" seq="3" name="area">
                            <option value=""> -- Selection --</option>
                            @if(isset($data["area"]))
                                @foreach ($data["area"] as $rarea)
                                    <option value="{{$rarea['areacode']}}">{{$rarea['description']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-3">
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">
                    Back
                </a>
                <button type="submit" seq="3" class="btn btn-primary enterseq" id="btnAction">Print</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        $j(document).ready(function (evt) {
            $j(".enterseq").each(function (i) {
                $j(this).keydown(function (event) {
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch (keycode) {
                        case 13:
                            if ($j(this).is("input")) {
                                $j(this).val($j(this).val().toUpperCase());
                            } else if ($j(this).is("button[type='submit']")) {
                                $j(this).click();
                                return false;
                            }
                            var dd = parseInt($j(this).attr("seq"), 10) + 1;
                            if ($j(".enterseq").filter("[seq='" + dd + "']").length > 0) {
                                if ($j(".enterseq").filter("[seq='" + dd + "']").is("input[type='text']")) {
                                    $j("input[type='text']").filter("[seq='" + dd + "']").select();
                                } else if ($j(".enterseq").filter("[seq='" + dd + "']").is("select")) {
                                    $j("select").filter("[seq='" + dd + "']").focus();
                                } else if ($j(".enterseq").filter("[seq='" + dd + "']").is("input[type='date']")) {
                                    $j("input[type='date']").filter("[seq='" + dd + "']").focus();
                                } else if ($j(".enterseq").filter("[seq='" + dd + "']").is("button")) {
                                    $j("button").filter("[seq='" + dd + "']").focus();
                                }
                            }
                            break;
                        case 38:
                            if ($j(this).is("select")) {
                                break;
                            }
                            var dd = (parseInt($j(this).attr("seq"), 10) > 0) ? (parseInt($j(this).attr("seq"), 10) - 1) : parseInt($j(this).attr("seq"), 10);
                            if ($j("input[type='text']").filter("[seq='" + dd + "']").length > 0) {
                                $j("input[type='text']").filter("[seq='" + dd + "']").select();
                                ;
                            } else if ($j("input[type='date']").filter("[seq='" + dd + "']").length > 0) {
                                $j("input[type='date']").filter("[seq='" + dd + "']").select();
                                ;
                            } else if ($j("select").filter("[seq='" + dd + "']").length > 0) {
                                $j("select").filter("[seq='" + dd + "']").focus();
                                ;
                            }
                            break;
                    }
                    if (keycode == 13) {
                        if ($j(this).attr("name") == "datfr" || $j(this).attr("name") == "datto") {
                            $j(".dropdown-menu").remove();
                            if ($j(this).val().length == 8) {
                                let date = new Date($j(this).val().substr(4, 4), ($j(this).val().substr(2, 2) - 1), $j(this).val().substr(0, 2));
                                var dd = date.getDate();
                                var mm = date.getMonth() + 1;
                                var yyyy = date.getFullYear();
                                if (dd < 10) {
                                    dd = '0' + dd;
                                }
                                if (mm < 10) {
                                    mm = '0' + mm;
                                }
                                console.log(dd + "/" + mm + "/" + yyyy);
                                $j(this).val(dd + "/" + mm + "/" + yyyy);
                            }
                        }
                        return false;
                    }
                })
            })
            // $j('.customerfromAutoSelect').autoComplete({
            //     minLength: 2,
            //     events: {
            //         searchPost: function (resultFromServer) {
            //             setTimeout(function () {
            //                 $j('.customerfromAutoSelect').next().find('a').eq(0).addClass("active");
            //             }, 100)
            //             return resultFromServer;
            //         }
            //     }
            // });
            // $j('.customerfromAutoSelect').keydown(function (event) {
            //     var keycode = (event.keyCode ? event.keyCode : event.which);
            //     if (keycode == 13) {
            //         $j("input").filter("[seq='2']").select();
            //         return false;
            //     }
            // })
            // $j('.customerfromAutoSelect').on('change', function (e, datum) {
            //     setTimeout(function () {
            //         if ($j('.customerfromAutoSelect').val() == "") {
            //             $j('.customerfromAutoSelect').focus();
            //         } else {
            //             var ss = $j('.customerfromAutoSelect').val().split("-");
            //             $j('.customerfromAutoSelect').val(ss[0]);
            //         }
            //     }, 300);
            //     return false;
            // });
            // $j("input.customerfromAutoSelect").attr("seq", "1");
            // $j('.customertoAutoSelect').autoComplete({
            //     minLength: 2,
            //     events: {
            //         searchPost: function (resultFromServer) {
            //             setTimeout(function () {
            //                 $j('.customertoAutoSelect').next().find('a').eq(0).addClass("active");
            //             }, 100)
            //             return resultFromServer;
            //         }
            //     }
            // });
            // $j('.customertoAutoSelect').keydown(function (event) {
            //     var keycode = (event.keyCode ? event.keyCode : event.which);
            //     if (keycode == 13) {
            //         $j("select").filter("[seq='3']").focus();
            //         return false;
            //     }
            // })
            // $j('.customertoAutoSelect').on('change', function (e, datum) {
            //     setTimeout(function () {
            //         if ($j('.customertoAutoSelect').val() == "") {
            //             $j('.customertoAutoSelect').focus();
            //         } else {
            //             var ss = $j('.customertoAutoSelect').val().split("-");
            //             $j('.customertoAutoSelect').val(ss[0]);
            //         }
            //     }, 300);
            //     return false;
            // });
            // $j('.customerfromAutoSelect').select()
            // $j("input.customertoAutoSelect").attr("seq", "2");
            // $j("input[name='datfr']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function (e) {
            //     $j(this).datepicker('hide');
            // });
            // $j("input[name='datto']").datepicker({format: "dd/mm/yyyy"}).on('changeDate', function (e) {
            //     $j(this).datepicker('hide');
            // });
            flatpickr("input[name='datfr']", { dateFormat: 'd/m/Y' });
            flatpickr("input[name='datto", { dateFormat: 'd/m/Y' });
        })
    </script>
@endsection

@section('topbar')

@endsection

@section('styles')
    <link href="{{ asset('js/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <style type="text/css">
        .dropdown-menu {
            /*width: 800px !important;*/ /* you can set by percentage too */
        }
        .datepicker {
            width: auto !important;
        }
        .modal-backdrop.show {
            opacity: 0.05;
        }
    </style>
@endsection
