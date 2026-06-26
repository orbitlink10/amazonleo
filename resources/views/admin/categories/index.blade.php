@extends('layouts.dashboard')

@section('title', 'Categories')
@section('dashboard-title', 'Categories')
@section('dashboard-subtitle', '')
@section('dashboard-actions')
    <a class="btn btn-primary rounded-pill fw-semibold px-4" href="{{ route('admin.categories.create') }}">Create New Category</a>
@endsection

@section('content')
@php
    $imageUrl = function (?string $image) {
        if (! $image) {
            return 'https://via.placeholder.com/140x90?text=No+Photo';
        }

        return str_starts_with($image, 'http') || str_starts_with($image, '//')
            ? $image
            : asset('storage/'.ltrim($image, '/'));
    };
@endphp
<div class="px-3 pb-4">
    <div class="card dashboard-content-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">ID</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Name</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Slug</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Photo</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td><img class="img-thumbnail" src="{{ $imageUrl($category->icon) }}" alt="{{ $category->name }}" style="width:100px;height:64px;object-fit:cover;"></td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a class="btn btn-sm btn-info text-white rounded-pill px-3" href="{{ route('admin.products.index', ['search' => $category->name]) }}">Show</a>
                                    <a class="btn btn-sm btn-warning rounded-pill px-3" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                                    <form method="post" action="{{ route('admin.categories.destroy', $category) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger rounded-pill px-3" type="submit" onclick="return confirm('Delete this category?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $categories->links() }}</div>
</div>
@endsection
