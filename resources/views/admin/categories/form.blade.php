@extends('layouts.dashboard')

@section('title', $category->exists ? 'Edit Category' : 'Create Category')
@section('dashboard-title', $category->exists ? 'Edit Category' : 'Create New Category')
@section('dashboard-subtitle', '')

@section('content')
@php
    $imageUrl = $category->icon
        ? (str_starts_with($category->icon, 'http') || str_starts_with($category->icon, '//') ? $category->icon : asset('storage/'.ltrim($category->icon, '/')))
        : null;
@endphp
<div class="px-3 pb-4">
    <div class="card dashboard-content-card">
        <div class="card-body">
            <form method="post" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                @if($category->exists) @method('put') @endif
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input class="form-control" name="slug" value="{{ old('slug', $category->slug) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Photo</label>
                        <input class="form-control" type="file" name="photo" accept="image/*">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active" @checked(old('is_active', $category->is_active ?? true))>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                    </div>
                    @if($imageUrl)
                        <div class="col-12">
                            <img class="img-thumbnail" src="{{ $imageUrl }}" alt="{{ $category->name }}" style="width:160px;height:100px;object-fit:cover;">
                        </div>
                    @endif
                </div>
                <button class="btn btn-primary rounded-pill mt-3 px-4">Save Category</button>
                <a class="btn btn-outline-secondary rounded-pill mt-3 px-4" href="{{ route('admin.categories.index') }}">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
