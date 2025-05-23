@extends('layouts.app')

@section('title', 'Upload Product Images')

@section('content')
    <h2>Upload Images for Product: {{ $product->name }}</h2>

    <form action="{{ route('products.images.store', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Upload Image</button>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">Back to Product</a>
    </form>

    <h3 class="mt-4">Existing Images</h3>
    <div class="row">
        @foreach ($product->images as $image)
            <div class="col-md-3 mb-3">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" alt="Product Image">
                <form action="{{ route('products.images.destroy', [$product->id, $image->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
