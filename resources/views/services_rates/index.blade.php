@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Services Rate Profile
                    @can('ADD SERVICES RATE PROFILE')
                        <a href="{{ url('services_rates/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create</a>
                    @endcan
                </h1>
            </div>

            @include('partials/messages')

            <div class="d-flex">
                {{ $servicerate->links("pagination::bootstrap-4") }}
                @if( $servicerate->hasMorePages() || (isset($searchValue) && $searchValue != ""))
                    <form action="{{action('App\Http\Controllers\ServiceRatesController@index')}}" method="POST">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{ ((isset($searchValue))?$searchValue:'') }}">
                        </div>
                    </form>
                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Effective Date</th>
                    <th>Service Description</th>
                    <th>Rate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($servicerate) && $servicerate->count()>0)
                    @foreach ($servicerate as $irow=> $rservicerate)
                        @php
                            $get_effective = json_decode($rservicerate->description);
                            $num=0;
                            $x = 0;
                            $seqno = 28;
                        @endphp
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ date('d/m/Y',strtotime($rservicerate->effectivedate)) }}</td>
                            <td>
                                @if($get_effective)
                                    @foreach($get_effective as $key => $value)
                                        @php $num++; @endphp
                                    @endforeach

                                    @foreach($get_effective as $key => $value)
                                        @php
                                            $x++;
                                                if($num == $x){
                                                    $com = '';
                                                } else {
                                                    $com = ',';
                                                }
                                        @endphp

                                        @if(isset($value->description))
                                            {{$value->description }} </br>
                                        @elseif(!is_numeric($value))
                                            {{$value}} </br>
                                        @endif

                                    @endforeach

                                @endif
                            </td>
                            <td>
                                @if($get_effective)

                                    @foreach($get_effective as $key => $value)
                                        @php $num++; @endphp
                                    @endforeach

                                    @foreach($get_effective as $key => $value)
                                        @php
                                            $x++;
                                                if($num == $x){
                                                    $com = '';
                                                } else {
                                                    $com = ',';
                                                }
                                        @endphp
                                        @if(isset($value->description))
                                            {{number_format((float) $value->rate, 2)}} </br>
                                        @elseif(is_numeric($value))
                                            {{$value}} </br>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW SERVICES RATE PROFILE')
                                        <a href="{{action('App\Http\Controllers\ServiceRatesController@show',$rservicerate->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT SERVICES RATE PROFILE')
                                        <a href="{{action('App\Http\Controllers\ServiceRatesController@edit',$rservicerate->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE SERVICES RATE PROFILE')
                                        <form action="{{action('App\Http\Controllers\ServiceRatesController@destroy', $rservicerate->id)}}" method="post" id="deleteForm_{{ $rservicerate->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rservicerate->id }})">
                                                Delete
                                            </button>
                                        </form>
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
        @include('partials/delete-confirm', ['title' => 'Service Rate Profile'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
