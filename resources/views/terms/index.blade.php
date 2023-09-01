@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Term
                    @can('ADD TERM')
                        <a href="{{ url('terms/create') }}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            @include('partials/messages')

            <div class="d-flex">
                {{ $terms->links("pagination::bootstrap-4") }}
                @if($terms->hasMorePages() || (isset($searchValue) && $searchValue!=""))
                    <form action="{{ action('App\Http\Controllers\TermsController@index') }}">
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
                        <th>Term</th>
                        <th>Description</th>
                        <th>Term Days</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @if(isset($terms) && $terms->count()>0)
                    @foreach ($terms as $irow=> $rterm)
                        <tr>
                            <th scope="row">{{ $irow+1 }}</th>
                            <td>{{ $rterm->term }}</td>
                            <td>{{ $rterm->description }}</td>
                            <td>{{ $rterm->termdays }}</td>
                            <td class="text-center col-2">
                                <div class="d-flex">
                                    @can('VIEW TERM')
                                        <a href="{{ action('App\Http\Controllers\TermsController@show',$rterm->id) }}"  class="btn btn-primary ">View</a>&nbsp;
                                    @endcan

                                    @can('EDIT TERM')
                                        <a href="{{ action('App\Http\Controllers\TermsController@edit',$rterm->id) }}"  class="btn btn-primary ">Edit</a>&nbsp;
                                    @endcan

                                    @can('DELETE TERM')
                                        <form action="{{ action('App\Http\Controllers\TermsController@destroy', $rterm->id) }}" method="post" id="deleteForm_{{ $rterm->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rterm->id }})">
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
        @include('partials/delete-confirm', ['title' => 'Term'])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endsection
