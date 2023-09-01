@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Services</h1>
            </div>

            @include('partials/messages')

            <div class="row">
                {{ $service->links("pagination::bootstrap-4") }}
                @if( $service->hasMorePages() || (isset($input['searchvalue']) && $input["searchvalue"] != "" ))
                    <form action="{{ action('App\Http\Controllers\CustomerServicesController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($input['searchvalue'])) ? $input['searchvalue'] : '')}}">
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
                    <th>Services</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @if(isset($service) && $service->count()>0)
                    @foreach ($service as $irow=> $rservice)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rservice->companycode }}</td>
                            <td>{{ $rservice->companyname }}</td>
                            <td>{!! $rservice->services !!}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('EDIT CUSTOMER SERVICE')
                                        <a href="{{ action('App\Http\Controllers\CustomerServicesController@edit',$rservice->id) }}?searchvalue={{ ((isset($input['searchvalue'])) ? $input['searchvalue'] : '') }}&page={{ ((isset($input['page']))?$input['page']:'') }}"  class="btn btn-primary">
                                            Modify
                                        </a>&nbsp;
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">No Record Found</td>
                    </tr>
                @endif
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        function js_openfile(file){
            window.open(file,'downloadfile');
        }
    </script>
@endsection
