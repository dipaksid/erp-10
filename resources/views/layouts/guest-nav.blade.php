<style>
    .error { font-weight: bold; color: #b31b1b; font-family: arial, verdana, sans-seriff; font-size: 12px; }
    body {
        margin: 0;
        padding: 0;
    }
    .sticky-header {
        left: 0;
        padding-left: 16%;
        padding-top: 1%;
        position: fixed;
        top: 0;
        width: 100%;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 100;
    }
    .sticky-header {
        height: 60px;
    }
    .headerLogin{
        vertical-align: top;
        display: inline-block;
        padding-top: 95px;
    }
</style>
<div id="app">
    <nav class="navbar sticky-top navbar-expand-sm navbar-light bg-white mb-4">
        <div class="container">
            <!-- Branding Image -->
            <header class="sticky-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong>{{ config('app.name', 'ERP10') }}</strong>
                </a>
            </header>
            <!-- Collapsed Hamburger -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                </ul>

            </div>
        </div>
    </nav>
</div>
@yield('content')
