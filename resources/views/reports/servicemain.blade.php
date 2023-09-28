@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading Start -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Service Maintenance Report</h1>
        </div>
        <!-- Page Heading End -->

        <div>
            @include('partials/messages')
            <form id="reportform" method="post" action="{{url('report/servicemain')}}" target="_blank">
                @csrf
                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Period (MM/YYYY)</label>
                        <input type="text" class="form-control enterseq" placeholder="mm/yyyy" name="period" seq="1"
                               maxlength="7"
                               value="{{ (isset($default['logindate']))?substr($default['logindate'],3):'' }}"/>
                    </div>
                    <div class="col-3">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Include Invoice [Y/N]</label>
                        <input type="text" class="form-control enterseq" name="inc_inv" seq="2" value="Y"/>
                    </div>
                    <div class="col-3">
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\HomeController@index') }}" class="btn btn-secondary btn-xs" id="btnBack">Back</a>
                <button type="submit" seq="3" class="btn btn-primary enterseq" maxlength="1" id="btnAction">Print</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
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
                        if ($j(this).attr("name") == "period") {
                            if ($j(this).val().length == 6) {
                                let date = new Date($j(this).val().substr(2, 4), ($j(this).val().substr(0, 2) - 1), 1);
                                var mm = date.getMonth() + 1;
                                var yyyy = date.getFullYear();
                                if (mm < 10) {
                                    mm = '0' + mm;
                                }
                                $j(this).val(mm + "/" + yyyy);
                            }
                        }
                        return false;
                    }
                    if ($j(this).attr("name") == "inc_inv") {
                        if (keycode != 89 && keycode != 78 && keycode != 46 && keycode != 8 && keycode != 37 && keycode != 39) {
                            return false;
                        }
                    }
                })
            })
            $j("input[name='period']").select();
        })
    </script>
@endsection

@section('topbar')


@endsection

@section('styles')
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
