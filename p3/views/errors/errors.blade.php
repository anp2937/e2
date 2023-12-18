@if ($app->errorsExist())
    <ul class='error alert alert-danger'>
        @foreach ($app->errors() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
