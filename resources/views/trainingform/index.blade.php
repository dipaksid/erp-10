@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Training Form
            @can('ADD TRAINING FORM')
                <a href="{{url('trainingform/create')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
            @endcan
        </h1>
        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>
    <div>
        @include('partials/messages')

        <div class="d-flex">
            {{ $training->links("pagination::bootstrap-4") }}
            @if($training->hasMorePages() || (isset($input['searchvalue']) && $input["searchvalue"]!=""))
            <form action="{{action('App\Http\Controllers\TrainingFormsController@index')}}">
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
                  <th>Category Code</th>
                  <th>Description</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($training) && $training->count()>0)
                    @foreach ($training as $irow=> $rcatg)
                    <tr>
                        <th scope="row">{{ $irow+1 }}</th>
                        <td>{{$rcatg->systemcod}}</td>
                        <td>{{$rcatg->description}}</td>
                        <td>{{$rcatg->form_title}}</td>
                        <td class="text-center col-2">
                            <div class="d-flex">
                                @can('VIEW TRAINING FORM')
                                <a href="{{action('App\Http\Controllers\TrainingFormsController@show',$rcatg->id)}}"  class="btn btn-primary ">View</a>&nbsp;
                                @endcan

                                @can('EDIT TRAINING FORM')
                                <a href="{{action('App\Http\Controllers\TrainingFormsController@edit',$rcatg->id)}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                @endcan

                                @can('SORT TRAINING FORM')
                                <a href="{{action('App\Http\Controllers\TrainingFormsController@sort',$rcatg->id)}}"  class="btn btn-info ">Sort</a>&nbsp;
                                @endcan

                                @can('DELETE TRAINING FORM')
                                <form action="{{action('App\Http\Controllers\TrainingFormsController@destroy', $rcatg->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                @endcan
                                &nbsp;
                                <a target="_blank"  href="{{action('App\Http\Controllers\TrainingFormsController@trainingformpdf',$rcatg->id)}}"  class="btn btn-success ">PDF</a>
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
