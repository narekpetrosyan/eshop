@extends('layouts.master')

@section('title', "Product")

@section('content')
    <h1>Iphone X 64gb</h1>
    <h2>{{$product}}</h2>
    <p>Price: $ 960 <b></b></p>

{{--    <img src="{{$product->image}}" alt="" >--}}
    <p>Best phone ever</p>
    <a href="">Add to card</a>
@endsection
