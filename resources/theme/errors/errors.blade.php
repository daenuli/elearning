@if ($errors->any())
    <div class="alert alert-danger dark mt-3" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif