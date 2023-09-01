@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Totalpay APP Services
                    @can('ADD TOTALPAY APP SERVICE')
                        <a href="{{ url('totalpayapp/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <div class="d-flex p-2">
                {{ $total_pay_app->links("pagination::bootstrap-4") }}
                @if($total_pay_app->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                    <form action="{{ action('App\Http\Controllers\TotalpayAppsController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($searchValue)) ? $searchValue : '') }}">
                        </div>
                    </form>
                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Customer Code</th>
                        <th>Customer Name</th>
                        <th>Accept Online Payment</th>
                        <th>Deals for you</th>
                        <th>Locate In Map</th>
                        <th>Get Gold Price</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($total_pay_app) && $total_pay_app->count()>0)
                    @foreach ($total_pay_app as $irow=> $rtotalpayapp)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rtotalpayapp->companycode }}</td>
                            <td>{{ $rtotalpayapp->companyname }}</td>
                            <td>{{ ($rtotalpayapp->b_acpt_op==1)?"YES":"NO" }}</td>
                            <td>{{ ($rtotalpayapp->b_dealforyou==1)?"YES":"NO" }}</td>
                            <td>{{ ($rtotalpayapp->b_locate==1)?"YES":"NO" }}</td>
                            <td>{{ ($rtotalpayapp->b_getgprc==1)?"YES":"NO" }}</td>
                            <td>{{ ($rtotalpayapp->active==1)?"YES":"NO" }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    {!! (($rtotalpayapp->qrpdfurl!="")?"<a href='".$rtotalpayapp->qrpdfurl."' class='btn btn-primary' target='_blank'><i class='fa fa-file-pdf'></i></a>":"") !!} &nbsp;

                                    @can('EDIT TOTALPAY APP SERVICE')
                                        <a href="{{ action('App\Http\Controllers\TotalpayAppsController@edit',$rtotalpayapp->id) }}?searchvalue={{ ((isset($searchValue)) ? $searchValue : '')}}&page={{ (request()->has('page') ? request()->get('page') : 1) }}" class="btn btn-primary">
                                            <i class='fa fa-edit'></i>
                                        </a>&nbsp;
                                    @endcan

                                    @can('DELETE TOTALPAY APP SERVICE')
                                        <form action="{{ action('App\Http\Controllers\TotalpayAppsController@destroy', $rtotalpayapp->id) }}" method="post" id="deleteForm_{{ $rtotalpayapp->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rtotalpayapp->id }})">
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="9">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('partials/delete-confirm', ['title' => 'Totalpay APP Services'])
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
@endsection
