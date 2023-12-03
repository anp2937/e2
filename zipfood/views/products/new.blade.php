@extends('templates/master')

@section('title')
    New Product
@endsection

@section('content')

    @if ($app->errorsExist())
        <div class='alert alert-danger'>Please correct the errors below</div>
    @endif

    <form method='POST' id='product-review' action='/products/save-product'>
        <h3>New Product</h3>
        <div class='form-group'>
            <label for='name'>Name</label>
            <input type='text' class='form-control' name='name' id='name'>
        </div>
        <div class='form-group'>
            <label for='name'>Sku</label>
            <input type='text' class='form-control' name='sku' id='name'>
        </div>
        <div class='form-group'>
            <label for='review'>description</label>
            <textarea name='description' id='review' class='form-control'></textarea>
            (Min: 200 characters)
        </div>

        <button type='submit' class='btn btn-primary'>Save</button>
    </form>

    @if ($app->errorsExist())
        <ul class='error alert alert-danger'>
            @foreach ($app->errors() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <a href='/products'>&larr; Return to all products</a>
@endsection
