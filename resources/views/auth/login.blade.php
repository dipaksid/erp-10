@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container @guest() headerLogin @endguest" >
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('partials.messages')

            <div class="card">

                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" autocomplete="on" id="login_form">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Name / E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                    <span class="invalid-feedback .text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback .text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="login_date" class="col-md-4 col-form-label text-md-end">{{ __('Login Date') }}</label>

                            <div class="col-md-6">
                                <input id="login_date" type="datetime-local" class="form-control @error('login_date') is-invalid @enderror" name="login_date" value="{{ date('d-m-Y') }}" required>

                                @error('login_date')
                                    <span class="invalid-feedback .text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        flatpickr("input[type=datetime-local]", { dateFormat: 'd-m-Y',defaultDate: "today" });
    </script>
    <script  type="module">
        $(function(){
            let loginForm = $("#login_form");
            if (loginForm.length > 0) {
                loginForm.validate({
                    rules: {
                        email: {
                            required: true,
                            maxlength: 50
                        },
                        password: {
                            required: true,
                        },
                        login_date: {
                            required: true,
                        },
                    },
                    messages: {
                        email: {
                            required: "Please enter name/email",
                        },
                        password: {
                            required: "Please enter valid password",
                        },
                        login_date: {
                            required: "Please select login_date",
                        },
                    },
                });
            }
        });
    </script>
@endsection
