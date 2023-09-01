@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="">
            <!-- Page Heading START -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">LEAVE FORM
                    @can('ADD LEAVE FORM')
                        <a href="{{url('leaveform/create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                            Create</a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading END -->

            @include('partials/messages')

            <div class="d-flex">
                {{ $leaveform->links("pagination::bootstrap-4") }}
                @if($leaveform->hasMorePages() || (isset($input['searchvalue']) && $input["searchvalue"]!=""))
                    <form action="{{action('App\Http\Controllers\LeaveFormsController@index')}}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($input['searchvalue']))?$input['searchvalue']:'')}}">
                        </div>
                    </form>
                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Doc No</th>
                    <th>Staff Name</th>
                    <th>Type</th>
                    <th>Applied At</th>
                    <th>Leave Duration</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($leaveform) && $leaveform->count()>0)
                    @foreach ($leaveform as $irow=> $rrow)
                        @php
                            if($rrow->status==1){
                              $form_status = 'Approved';
                            }
                            if($rrow->status==2){
                              $form_status = 'Pending';
                            }
                            if($rrow->status==0){
                              $form_status = 'Rejected';
                            }
                        @endphp
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{$rrow->doc_no}}</td>
                            <td>{{$rrow->staff_name}}</td>
                            <td>{{$rrow->leave_typ}} </td>
                            <td>{{$rrow->applied_dat}}</td>
                            <td>{{$rrow->leave_duration}}</td>
                            <td>{{$rrow->leave_dat_frm}}</td>
                            <td>{{$rrow->leave_dat_to}}</td>
                            @if($rrow->status==1)
                                <td>
                                    <span class="badge badge-pill badge-success">Approved</span></br>
                                    <span class="badge badge-pill badge-success">{{$rrow->approved_by}}</span><br>
                                    <span class="badge badge-pill badge-success">{{$rrow->approved_dat}}</span>
                                </td>
                            @else
                                @if($rrow->status==2)
                                    <td><span class="badge badge-pill badge-warning">Pending</span></td>
                                @else
                                    <td><span class="badge badge-pill badge-danger">Rejected</span></td>
                                @endif
                            @endif
                            <td class="text-center col-2">
                                <div class="d-flex">

                                    @can('VIEW LEAVE FORM')
                                        <a href="{{action('App\Http\Controllers\LeaveFormsController@show',$rrow->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT LEAVE FORM')
                                        <a href="{{action('App\Http\Controllers\LeaveFormsController@edit',$rrow->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE LEAVE FORM')
                                        <form action="{{action('App\Http\Controllers\LeaveFormsController@destroy', $rrow->id)}}" method="post" id="deleteForm_{{ $rrow->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rrow->id }})">
                                                Delete
                                            </button>

                                        </form>
                                    @endcan
                                    <span class="pl-1">
                                        <a target="_blank"  href="{{ action('App\Http\Controllers\LeaveFormsController@leaveformpdf', $rrow->id) }}"  class="btn btn-success ">PDF</a>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="10">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
        @include('partials/delete-confirm', ['title' => 'Leave Form'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
