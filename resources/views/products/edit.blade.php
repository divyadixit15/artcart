@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Price ($)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="images">Product Images (Select Multiple)</label>
            <div class="mb-2">
                @foreach($product->images as $image)
                    <div class="d-flex">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" width="100" alt="Product Image">
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage({{ $image->id }})">Delete</button>
                    </div>
                @endforeach
            </div>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            @error('images') 
                <div class="text-danger">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <script>
        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`/products/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
