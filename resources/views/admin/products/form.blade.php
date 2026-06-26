@extends('layouts.dashboard')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')
@section('dashboard-title', $product->exists ? 'Edit Product' : 'Add Product')
@section('dashboard-subtitle', 'Fill in the product details below to add a new item.')

@section('content')
@php
    $imageUrl = $product->image
        ? (str_starts_with($product->image, 'http') || str_starts_with($product->image, '//') ? $product->image : route('media.image', ['path' => ltrim($product->image, '/')]))
        : null;
@endphp
<style>
    .product-form-screen, .product-form-screen .form-control, .product-form-screen .form-select, .product-form-screen .btn { font-size:15px; }
    .product-form-screen .form-label { font-size:15px; margin-bottom:6px; }
    .local-editor { border:1px solid #dee2e6; border-radius:12px; overflow:hidden; background:#fff; }
    .local-editor-toolbar { display:flex; flex-wrap:wrap; align-items:center; gap:8px; padding:10px 12px; border-bottom:1px solid #e5e7eb; background:#f8fafc; }
    .local-editor-toolbar select, .local-editor-toolbar button { height:34px; border:1px solid #d8dee8; border-radius:8px; background:#fff; color:#334155; font-size:14px; }
    .local-editor-toolbar button { width:36px; display:grid; place-items:center; }
    .local-editor-area { min-height:320px; padding:16px; outline:0; font-size:15px; line-height:1.6; }
</style>
<div class="px-3 pb-4 product-form-screen">
    <div class="card dashboard-content-card">
        <div class="card-body">
            <form method="post" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @if($product->exists) @method('put') @endif
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input class="form-control" name="name" value="{{ old('name', $product->name) }}" placeholder="Enter product name" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Price (KES)</label>
                        <input class="form-control" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price ?? 0) }}" placeholder="Enter product price" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Marked Price (KES)</label>
                        <input class="form-control" name="marked_price" type="number" min="0" step="0.01" value="{{ old('marked_price', $product->marked_price ?? 0) }}" placeholder="Enter marked price">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Quantity</label>
                        <input class="form-control" name="quantity" type="number" min="0" step="1" value="{{ old('quantity', $product->quantity ?? 0) }}" placeholder="Enter product quantity">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Subcategory</label>
                        <input class="form-control" list="subcategory-options" name="subcategory" value="{{ old('subcategory', $product->subcategory) }}" placeholder="Select Subcategory">
                        <datalist id="subcategory-options">
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory }}">
                            @endforeach
                        </datalist>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="4">{{ old('meta_description', $product->meta_description) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control js-editor-source d-none" name="description">{{ old('description', $product->description) }}</textarea>
                        <div class="local-editor" data-editor>
                            <div class="local-editor-toolbar">
                                <button type="button" data-cmd="undo" title="Undo"><i class="bi bi-arrow-counterclockwise"></i></button>
                                <button type="button" data-cmd="redo" title="Redo"><i class="bi bi-arrow-clockwise"></i></button>
                                <select data-block title="Text style">
                                    <option value="p">Paragraph</option>
                                    <option value="h1">Header 1</option>
                                    <option value="h2">Header 2</option>
                                    <option value="h3">Header 3</option>
                                    <option value="h4">Header 4</option>
                                </select>
                                <button type="button" data-cmd="bold" title="Bold"><i class="bi bi-type-bold"></i></button>
                                <button type="button" data-cmd="italic" title="Italic"><i class="bi bi-type-italic"></i></button>
                                <button type="button" data-cmd="justifyLeft" title="Align left"><i class="bi bi-text-left"></i></button>
                                <button type="button" data-cmd="justifyCenter" title="Align center"><i class="bi bi-text-center"></i></button>
                                <button type="button" data-cmd="justifyRight" title="Align right"><i class="bi bi-text-right"></i></button>
                                <button type="button" data-cmd="insertUnorderedList" title="Bullet list"><i class="bi bi-list-ul"></i></button>
                                <button type="button" data-link title="Link"><i class="bi bi-link-45deg"></i></button>
                            </div>
                            <div class="local-editor-area" contenteditable="true">{!! old('description', $product->description) !!}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Slug</label>
                        <input class="form-control" name="slug" value="{{ old('slug', $product->slug) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image URL</label>
                        <input class="form-control" name="image" value="{{ old('image', $product->image) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Upload Image</label>
                        <input class="form-control" type="file" name="image_file" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="google_merchant" value="1" id="merchant" @checked(old('google_merchant', $product->google_merchant))>
                            <label class="form-check-label" for="merchant">Google Merchant</label>
                        </div>
                    </div>
                    @if($imageUrl)
                        <div class="col-12">
                            <img class="img-thumbnail" src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width:180px;height:120px;object-fit:contain;" onerror="this.style.display='none';">
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

@push('scripts')
<script>
    document.querySelectorAll('[data-editor]').forEach(function (editor) {
        const source = editor.previousElementSibling;
        const area = editor.querySelector('.local-editor-area');
        const block = editor.querySelector('[data-block]');
        const sync = () => { source.value = area.innerHTML.trim(); };

        editor.querySelectorAll('[data-cmd]').forEach(function (button) {
            button.addEventListener('click', function () {
                area.focus();
                document.execCommand(button.dataset.cmd, false, null);
                sync();
            });
        });

        block.addEventListener('change', function () {
            area.focus();
            document.execCommand('formatBlock', false, block.value);
            sync();
        });

        editor.querySelector('[data-link]').addEventListener('click', function () {
            const url = window.prompt('Enter URL');
            if (url) {
                area.focus();
                document.execCommand('createLink', false, url);
                sync();
            }
        });

        area.addEventListener('input', sync);
        area.closest('form').addEventListener('submit', sync);
    });
</script>
@endpush
