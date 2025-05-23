@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <h2>Add New Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-3">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="price">Product Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="images">Product Images (Select Multiple)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            @error('images.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
@endsection
