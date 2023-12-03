@extends('templates/master')

@section('title')
    {{ $app->config('app.name') }}
@endsection

@section('content')
    <h2>Product not found</h2>
    {{-- This comment will not be present in the rendered HTML --}}
    <p>
        Sorry, we were not able to find the product you were looking for.
    </p>

    <p>
        <a href='/products'>Check out our other products...</a>
    </p>
@endsection
