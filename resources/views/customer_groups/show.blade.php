@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer Group</h1>
        </div>

        @include('partials/messages')

        <form method="post" >
            <div class="row form-group">
                <div class="col-3">
                    <label for="title">Group Code:</label>
                    <input type="text" class="form-control" name="groupcode" value="{{$group->groupcode}}" disabled />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-9">
                    <label for="title">Description:</label>
                    <input type="text" class="form-control" name="description" value="{{$group->description}}" disabled />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="system_id">System ID: <span style="color:red;">*</span>:</label>
                    <select class="form-control enterseq" seq="3" name="category_id" disabled>
                        <option value=""> -- Selection --</option>
                        @if($categorylist)
                            @foreach ($categorylist as $rcatg)
                                <option value="{{$rcatg['id']}}" {{ (($rcatg['id']==$group['customer_categories_id'])?"selected":"") }}>{{$rcatg['description']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="companyid">Service Form Folder Name: :</label>
                    <input type="text" seq="5" class="form-control enterseq" name="foldername" value="{{$group->foldername}}" disabled />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-10">
                    <table class="table" id="tblcust">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Customers</th>
                            <th>Period Type</th>
                            <th>Amount</th>
                            <th>Include Hardware [Y/N]</th>
                            <th>Pay Before Service[Y/N]</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Service<br>Pay Date</th>
                            <th>Software License Per PC</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupdetail as $nd => $rdet)
                                <tr>
                                    <td scope="row">
                                        <input type='hidden' name='detid[]' value='{{ $rdet->id }}'>
                                        <input type='hidden' name='cust[]' value='{{ $rdet->customerid }}'>
                                        <span>{{ ($nd + 1) }}</span>
                                    </td>
                                    <td>{{ $rdet->companycode . "-" . $rdet->companyname }}</td>
                                    <td>{{ $rdet->contract_typ }}</td>
                                    <td>{{ $rdet->amount }}</td>
                                    <td>{{ $rdet->inc_hw }}</td>
                                    <td>{{ $rdet->pay_before }}</td>
                                    <td>{{ $rdet->start_date }}</td>
                                    <td>{{ $rdet->end_date }}</td>
                                    <td>{{ $rdet->service_date }}</td>
                                    <td>{{ $rdet->soft_license }}</td>
                                    <td>{{ $rdet->active }}</td>
                                </tr>
                            @endforeach
                                @if ($groupdetail->isEmpty())
                                    <tr class="empty">
                                        <td class="text-center" colspan="11">No Record Found</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ action('App\Http\Controllers\CustomerGroupsController@index') }}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}" class="btn btn-secondary btn-xs">Back</a>
        </form>
    </div>
    </div>
@endsection
