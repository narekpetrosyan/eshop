@extends('layouts.master')

@section('title', 'Index Page')


@section('content')

    <h1>All products</h1>

    <div class="row">
        @foreach($products as $product)
            @include('layouts.card',['product' => $product])
        @endforeach
    </div>


@endsection
