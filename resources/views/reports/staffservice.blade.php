@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container-fluid">
    <!-- Page Heading Start -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Service Report</h1>
    </div>
    <!-- Page Heading End -->
    <div>

        @include('partials/messages')

        <form id="reportform" method="post" action="{{url('report/staffservice')}}" target="_blank">
            @csrf

            <div class="row form-group">
                <div class="col-3">
                    <label for="permissions">Staffs: <input type="checkbox" id="all_staff" value="0"/> All</label>
                    <div class="d-flex">
                        @foreach ($user as $users)
                            <div class="col-4">
                                <input type="checkbox" name="staff[]" id="staff"
                                       value="{{$users->name}}"/> {{$users->name}}
                            </div>
                        @endforeach
                        <br>
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Date From:</label>
                    <input type="text" class="form-control enterseq" placeholder="dd/mm/yyyy" name="datfr" seq="3"
                           value="{{ (isset($default['logindate']))?$default['logindate']:'' }}"/>
                </div>
                <div class="col-3">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Date To:</label>
                    <input type="text" class="form-control enterseq" placeholder="dd/mm/yyyy" name="datto" seq="4"
                           value="{{ (isset($default['logindate']))?$default['logindate']:'' }}"/>
                </div>
                <div class="col-3">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Service Type:</label>
                    <select class="form-control enterseq" seq="5" id="servicetype" name="servicetype">
                        <option value="0">All</option>
                        <option value="1">Service</option>
                        <option value="2">Installation</option>
                        <option value="3">Training</option>
                        <option value="4">Hardware</option>
                    </select>
                </div>
                <div class="col-3">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Details / Summary:</label>
                    <select class="form-control enterseq" seq="6" id="details" name="details">
                        <option value="1">Details</option>
                        <option value="2">Summary</option>
                    </select>
                </div>
                <div class="col-3">
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
            <button type="submit" seq="7" class="btn btn-primary enterseq" id="btnAction">Print</button>
        </form>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        $j("#all_staff").click(function () {
            $j('input:checkbox').not(this).prop('checked', this.checked);
        });
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
            //
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
            //$j("input.customertoAutoSelect").attr("seq", "2");
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

@section('scripts')
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


