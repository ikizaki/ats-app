@extends('layouts.app')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">All Products</h4>
                </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                @forelse ($products as $product)
                                    <div class="col-md-4">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                @if ($product->quantity > 0)
                                                    <label class="stock bg-success">In Stock</label>
                                                @else
                                                    <label class="stock bg-danger">Out of Stock</label>
                                                @endif

                                                @if ($product->productImages->count() > 0)
                                                    <a
                                                        href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                                        <img src="{{ asset($product->productImages[0]->image) }}"
                                                            alt="{{ $product->name }}">
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-card-body">
                                                <p class="product-brand">{{ $product->brand }}</p>
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <span class="selling-price">{{ $product->selling_price }}</span>
                                                    <span class="original-price">{{ $product->original_price }}</span>
                                                </div>
                                                <div class="mt-2">
                                                    <a href="" class="btn btn1">Add To Cart</a>
                                                    <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                                    <a href="" class="btn btn1"> View </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-3">
                                        <div class="p-2">
                                            <h5>No Products Available for {{ $category->name }}</h5>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
