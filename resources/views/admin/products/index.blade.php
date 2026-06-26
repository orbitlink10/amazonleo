@extends('layouts.dashboard')

@section('title', 'Products')
@section('dashboard-title', 'Products')
@section('dashboard-subtitle', 'Manage and view all products available in the system')
@section('dashboard-actions')
    <a class="btn btn-primary rounded-pill fw-semibold px-4" href="{{ route('admin.products.create') }}"><i class="bi bi-plus-lg"></i> Add Product</a>
@endsection

@section('content')
@php
    $imageUrl = function (?string $image) {
        if (! $image) {
            return 'https://via.placeholder.com/180x120?text=No+Image';
        }

        return str_starts_with($image, 'http') || str_starts_with($image, '//')
            ? $image
            : asset('storage/'.ltrim($image, '/'));
    };
@endphp
<div class="px-3 pb-4">
    <section class="card dashboard-content-card overflow-hidden">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <h2 class="card-title mb-0">Product List</h2>
            <form class="d-flex gap-2" method="get" action="{{ route('admin.products.index') }}">
                <input class="form-control rounded-pill" name="search" value="{{ $search }}" placeholder="Search by product name...">
                <button class="btn btn-primary rounded-pill fw-semibold px-4" type="submit"><i class="bi bi-search"></i> Search</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Image</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Name</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Slug</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Price (KES)</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Quantity</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Google Merchant</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Category</th>
                        <th class="text-uppercase text-muted" style="letter-spacing:.16em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                            <td><img src="{{ $imageUrl($product->image) }}" alt="{{ $product->name }}" style="width:150px;height:96px;object-fit:contain;"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ number_format((float) $product->price, 2) }}<br><span class="text-muted">( {{ (float) $product->price > 0 ? 'has price' : 'no price' }} )</span></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->google_merchant ? 'Yes' : 'No' }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <a class="btn btn-sm btn-outline-primary rounded-pill" href="{{ route('admin.products.edit', $product) }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    <form method="post" action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill w-100" type="submit" onclick="return confirm('Delete this product?')"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted py-4">No products found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    <div class="mt-3">{{ $products->links() }}</div>
</div>
@endsection
