@extends('layouts.dashboard')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')
@section('dashboard-title', $product->exists ? 'Edit Product' : 'Add Product')
@section('dashboard-subtitle', '')

@section('content')
@php
    $imageUrl = $product->image
        ? (str_starts_with($product->image, 'http') || str_starts_with($product->image, '//') ? $product->image : asset('storage/'.ltrim($product->image, '/')))
        : null;
@endphp
<div class="px-3 pb-4">
    <div class="card dashboard-content-card">
        <div class="card-body">
            <form method="post" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @if($product->exists) @method('put') @endif
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input class="form-control" name="slug" value="{{ old('slug', $product->slug) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Price (KES)</label>
                        <input class="form-control" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price ?? 0) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image URL</label>
                        <input class="form-control" name="image" value="{{ old('image', $product->image) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Upload Image</label>
                        <input class="form-control" type="file" name="image_file" accept="image/*">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="google_merchant" value="1" id="merchant" @checked(old('google_merchant', $product->google_merchant))>
                            <label class="form-check-label" for="merchant">Google Merchant</label>
                        </div>
                    </div>
                    @if($imageUrl)
                        <div class="col-12">
                            <img class="img-thumbnail" src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width:180px;height:120px;object-fit:contain;">
                        </div>
                    @endif
                </div>
                <button class="btn btn-primary rounded-pill mt-3 px-4">Save Product</button>
                <a class="btn btn-outline-secondary rounded-pill mt-3 px-4" href="{{ route('admin.products.index') }}">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
