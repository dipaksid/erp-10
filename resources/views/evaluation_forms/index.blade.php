@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">EVALUATION FORM
                    @can('ADD EVALUATION FORM')
                        <a href="{{ url('evaluation-forms/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create
                        </a>
                    @endcan
                </h1>
            </div>

            @include('partials/messages')

            <div class="d-flex">
                {{ $evaluation->links("pagination::bootstrap-4") }}
                @if($evaluation->hasMorePages() || (isset($searchValue) && $searchValue!=""))
                    <form action="{{ action('App\Http\Controllers\EvaluationFormsController@index') }}">
                        <div class="col-12">
                            <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($searchValue))?$searchValue:'')}}">
                        </div>
                    </form>
                @endif
            </div>

            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @if(isset($evaluation) && $evaluation->count()>0)
                    @foreach ($evaluation as $irow=> $rrow)
                        @php
                            if($rrow->status==1){
                              $form_status = 'Active';
                            } else {
                              $form_status = 'Inactive';
                            }
                        @endphp
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{$rrow->form_title}}</td>
                            <td>{{$form_status}}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">

                                    @can('VIEW EVALUATION FORM')
                                        <a href="{{action('App\Http\Controllers\EvaluationFormsController@show',$rrow->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT EVALUATION FORM')
                                        <a href="{{action('App\Http\Controllers\EvaluationFormsController@edit',$rrow->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('SORT EVALUATION FORM')
                                        <a href="{{action('App\Http\Controllers\EvaluationFormsController@sort',$rrow->id)}}"  class="btn btn-info ">Sort</a>&nbsp;
                                    @endcan

                                    @can('DELETE EVALUATION FORM')
                                        <form action="{{action('App\Http\Controllers\EvaluationFormsController@destroy', $rrow->id)}}" method="post" id="deleteForm_{{ $rrow->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rrow->id }})">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                    &nbsp;
                                    <a target="_blank" href="{{ action('App\Http\Controllers\EvaluationFormsController@evaluationformpdf',$rrow->id) }}"  class="btn btn-success">
                                        PDF
                                    </a>
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
        @include('partials/delete-confirm', ['title' => 'EVALUATION FORM'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
