@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">PWS PG APP Services
                    @can('ADD PWS PG APP SERVICE')
                        <a href="{{ url('customer-pwspg-app/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>

            @include('partials/messages')

            <div class="d-flex">
                {{ $pwspgapp->links("pagination::bootstrap-4") }}
                @if($pwspgapp->hasMorePages() || (isset($input['searchvalue']) && $input["searchvalue"]!=""))

                    <form action="{{action('App\Http\Controllers\CustomerPGAppsController@index')}}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($input['searchvalue'])) ? $input['searchvalue'] : '') }}">
                        </div>
                    </form>

                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>App ID</th>
                    <th>Name</th>
                    <th>Mobile Phone</th>
                    <th>Customers</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($pwspgapp) && $pwspgapp->count()>0)
                    @foreach ($pwspgapp as $irow=> $rpwspgapp)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{$rpwspgapp->username}}</td>
                            <td>{{$rpwspgapp->first_name}}</td>
                            <td>{{$rpwspgapp->mob_pho}}</td>
                            <td>{!!$rpwspgapp->customer!!}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('EDIT PWS PG APP SERVICE')
                                        <a href="{{ action('App\Http\Controllers\CustomerPGAppsController@edit',$rpwspgapp->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'') }}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE PWS PG APP SERVICE')
                                        <form action="{{ action('App\Http\Controllers\CustomerPGAppsController@destroy', $rpwspgapp->id) }}" method="post" id="deleteForm_{{ $rpwspgapp->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rpwspgapp->id }})">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="6">No Record Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('partials/delete-confirm', ['title' => 'PWS PG APP Service'])
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
@endsection
