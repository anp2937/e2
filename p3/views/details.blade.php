@extends('templates/master')

@section('title')
    {{ $welcome }}
@endsection

@section('body')
    <h1>Round {{ $email }}</h1>

    <a href='/history'>&larr; Back to Game History</a>
@endsection
