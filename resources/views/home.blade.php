<!--
extends('layouts.base')
section('title')
bbbbbbbbbbbbbbbb
endsection
section('content')
-->

<x-base-layout>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just
            like the one in previous versions of Bootstrap. Check out the examples below for how you
            can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
</div>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($products as $product)
            <div class="col">
                <div class="card shadow-sm">
                    <img class="bd-placeholder-img card-img-top" src="{{ $product->img }}">
                    <div class="card-body">
                        <p class="card-text">{{ $product->name }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('cart.add',$product) }}"
                                    class="btn btn-sm btn-outline-success">Comprar</a>
                                <a href="#" class="btn btn-sm btn-outline-success">Share</a>
                            </div>
                            <p class="fw-bold">R$ {{ $product->price }}</p>
                        </div>
                        <a href="#" class="link-warning">+ Warning link</a>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>

    @if($products instanceof \Illuminate\Pagination\AbstractPaginator)

        {{$products->links()}}

    @endif
</div>

</x-base-layout>

endsection
