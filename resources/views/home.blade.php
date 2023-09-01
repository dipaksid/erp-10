@extends('layouts.app')

@section('title', 'ERP10-Home')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @include('partials.messages')

        @yield('content')
        <div class="modal fade" id="submitProcessModal" tabindex="-1" role="dialog" aria-labelledby="submitProcessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitProcessModal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

