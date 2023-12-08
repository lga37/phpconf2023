<!--
extends('layouts.base')

section('title')Carrinho
endsection

section('content')
-->
<x-base-layout>

<h1>Cart</h1>

<table class="table table-striped table-hover">
    @foreach (session()->get('cart')??[] as $product)

        <tr>
            <td><img src="{{ $product->img }}" width="60" class="img-carrinho rounded-circle" alt=""></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <div class="btn-group me-2">
                    <a href="#" class="btn btn-outline-secondary">-</a>
                    <a href='#' class="btn disabled">{{ $product->qty }}</a>
                    <a href="{{ route('cart.incr',$product)}}" class="btn btn-outline-secondary">+</a>
                </div>
            </td>
            <td>{{ $product->price * $product->qty }}</td>
            <td><a href="{{ route('cart.del',$product)}}" class="btn btn-sm btn-outline-danger">del</a></td>
        </tr>

    @endforeach

        <tr><td colspan=4></td><td><h2>R$
        @php
        echo collect(session()->get('cart'))
            ->reduce(function($carry, $product){
                return $carry + ($product['qty']*$product['price']);
            });

        @endphp
        </h2></td><td></td>
        </tr>
    </table>

    <a href="{{ route('cart.clear') }}" class="btn btn-lg btn-outline-danger">Cancelar</a>
    <a href="{{ route('checkout') }}" class="ms-4 btn btn-lg btn-outline-success">Checkout</a>

endsection
</x-base-layout>
