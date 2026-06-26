@extends('layouts.dashboard')

@section('title', $category->exists ? 'Edit Category' : 'Create Category')
@section('dashboard-title', $category->exists ? 'Edit Category' : 'Create New Category')
@section('dashboard-subtitle', '')

@section('content')
@php
    $imageUrl = $category->icon
        ? (str_starts_with($category->icon, 'http') || str_starts_with($category->icon, '//') ? $category->icon : route('media.image', ['path' => ltrim($category->icon, '/')]))
        : null;
@endphp
<style>
    .local-editor { border:1px solid #dee2e6; border-radius:12px; overflow:hidden; background:#fff; }
    .local-editor-toolbar { display:flex; flex-wrap:wrap; align-items:center; gap:8px; padding:10px 12px; border-bottom:1px solid #e5e7eb; background:#f8fafc; }
    .local-editor-toolbar select, .local-editor-toolbar button { height:34px; border:1px solid #d8dee8; border-radius:8px; background:#fff; color:#334155; font-size:14px; }
    .local-editor-toolbar button { width:36px; display:grid; place-items:center; }
    .local-editor-area { min-height:260px; padding:16px; outline:0; font-size:15px; line-height:1.6; }
</style>
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
                        <label class="form-label fw-semibold">Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="4">{{ old('meta_description', $category->meta_description) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control js-editor-source d-none" name="description">{{ old('description', $category->description) }}</textarea>
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
                            <div class="local-editor-area" contenteditable="true">{!! old('description', $category->description) !!}</div>
                        </div>
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
                            <img class="img-thumbnail" src="{{ $imageUrl }}" alt="{{ $category->name }}" style="width:160px;height:100px;object-fit:cover;" onerror="this.style.display='none';">
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
