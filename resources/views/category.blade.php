@extends('layouts.master')

@section('title', "Category")

@section('content')
    <h1>
        {{$category->name}}  {{$category->products->count()}}
    </h1>
    <p>
        {{$category->description}}
    </p>
    <div class="row">
        @foreach($category->products as $product)
            @include('layouts.card',['category' => $category])
        @endforeach
    </div>
@endsection
