@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Customer Service</h1>
            </div>

            @include('partials/messages')

            <form method="post" >

                <div class="row form-group">
                    <div class="col-3">
                        <label for="title">Group Code:</label>
                        <input type="text" class="form-control" name="groupcode" value="{{ $customerService->groupcode }}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <label for="title">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{ $customerService->description }}" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-5">
                        <table class="table" id="tblcust">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th>Customers</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($groupdetail->exists())
                                @foreach ($groupdetail->get() as $nd=> $rdet)
                                    <tr>
                                        <td scope="row"><input type='hidden' name='detid[]' value='{{$rdet->id}}'><input type='hidden' name='cust[]' value='{{$rdet->customerid}}'><span>{{($nd+1)}}</span></td>
                                        <td>{{$rdet->companycode."-".$rdet->companyname}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="empty">
                                    <td class="text-center" colspan="3">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\CustomerServicesController@index') }}" class="btn btn-secondary btn-xs">Back</a>

            </form>
        </div>
    </div>
@endsection
