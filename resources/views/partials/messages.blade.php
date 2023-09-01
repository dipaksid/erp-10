@if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="close close-position" onclick="hideSuccessMessage()">
            <span>&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
