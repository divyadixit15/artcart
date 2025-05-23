@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h2>{{ $product->name }}</h2>
    <p><strong>Price: </strong>${{ $product->price }}</p>

    <h3>Product Images</h3>
    <div class="row">
        @foreach ($product->images as $image)
            <div class="col-md-3">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" width="200" alt="Product Image">
            </div>
        @endforeach
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Product List</a>
@endsection
