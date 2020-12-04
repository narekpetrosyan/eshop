@extends('layouts.master')

@section('title', "Basket")

@section('content')
    <h1>@lang('basket.cart')</h1>
    <p>@lang('basket.ordering')</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Count</th>
                <th>Price</th>
                <th>Cost</th>
            </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td>
                            <a href="{{route('product',[$product->category->code,$product->code])}}">
                                <img height="56px" src="{{ $product->image }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>
                            <div class="btn-group form-inline">
                                <form action="{{route('basket-remove',$product)}}" method="POST">
                                    <button type="submit" class="btn btn-danger" href=""><span
                                            class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                    @csrf
                                </form>
                                <span class="badge">{{$product->pivot->count}}</span>
                                <form action="{{route('basket-add',$product)}}" method="POST">
                                    <button type="submit" class="btn btn-success"
                                            href=""><span
                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                    @csrf
                                </form>
                            </div>
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->getPriceForCount($product->pivot->count) }}</td>
                    </tr>
                @endforeach
            <tr>
                <td colspan="3">Full Price</td>
                <td> {{$order->getFullPrice()}}</td>
            </tr>
            </tbody>
        </table>

        <br>
        <div class="row">
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success"
                   href="{{route('basket-place')}}">Checkout Order</a>
            </div>
        </div>
@endsection
