@if(session('success') || session('errror'))
    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }}">
        {{ session('success') ?: session('error') }}
    </div>
@endif