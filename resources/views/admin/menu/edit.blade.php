@extends('layouts.dashboard')
@section('title', 'Menu')
@section('dashboard-title', '')
@section('dashboard-subtitle', '')
@section('content')
<div class="adminlte-content-wrapper">
    <section class="adminlte-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="adminlte-content">
        <div class="container-fluid">
            <form method="post" action="{{ route('admin.menu.update') }}">
                @csrf
                @method('put')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Main Header Menu</h3>
                    </div>
                    <div class="card-body">
                        <div id="primary-menu-rows" class="menu-rows">
                            @foreach(old('primary_items', $primaryItems) as $index => $item)
                                <div class="menu-row" data-row>
                                    <div>
                                        <label>Label</label>
                                        <input class="form-control" type="text" name="primary_items[{{ $index }}][label]" value="{{ $item['label'] ?? '' }}">
                                    </div>
                                    <div>
                                        <label>Hyperlink</label>
                                        <input class="form-control" type="text" name="primary_items[{{ $index }}][url]" value="{{ $item['url'] ?? '#' }}" placeholder="#section, /page, or https://...">
                                    </div>
                                    <label class="menu-check">
                                        <input type="hidden" name="primary_items[{{ $index }}][has_dropdown]" value="0">
                                        <input type="checkbox" name="primary_items[{{ $index }}][has_dropdown]" value="1" @checked(! empty($item['has_dropdown']))>
                                        <span>Show arrow</span>
                                    </label>
                                    <button class="btn btn-outline-danger menu-remove" type="button">Delete</button>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-outline-primary mt-3" type="button" data-add-row="primary">Add Menu Item</button>
                    </div>
                </div>

                <div class="card card-primary mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Personal / Business Buttons</h3>
                    </div>
                    <div class="card-body">
                        <div id="audience-menu-rows" class="menu-rows">
                            @foreach(old('audience_items', $audienceItems) as $index => $item)
                                <div class="menu-row" data-row>
                                    <div>
                                        <label>Label</label>
                                        <input class="form-control" type="text" name="audience_items[{{ $index }}][label]" value="{{ $item['label'] ?? '' }}">
                                    </div>
                                    <div>
                                        <label>Hyperlink</label>
                                        <input class="form-control" type="text" name="audience_items[{{ $index }}][url]" value="{{ $item['url'] ?? '#' }}" placeholder="#section, /page, or https://...">
                                    </div>
                                    <label class="menu-check">
                                        <input type="hidden" name="audience_items[{{ $index }}][is_active]" value="0">
                                        <input type="checkbox" name="audience_items[{{ $index }}][is_active]" value="1" @checked(! empty($item['is_active']))>
                                        <span>Highlighted</span>
                                    </label>
                                    <button class="btn btn-outline-danger menu-remove" type="button">Delete</button>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-outline-primary mt-3" type="button" data-add-row="audience">Add Button</button>
                    </div>
                </div>

                <div class="card card-primary mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Mobile Menu Icon</h3>
                    </div>
                    <div class="card-body">
                        <label for="mobile_menu_url">Hyperlink</label>
                        <input id="mobile_menu_url" class="form-control" type="text" name="mobile_menu_url" value="{{ old('mobile_menu_url', $mobileMenuUrl) }}" placeholder="#installation-support">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Save Menu</button>
                        <a class="btn btn-outline-primary ms-2" href="{{ route('home') }}" target="_blank">View Homepage</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<template id="primary-row-template">
    <div class="menu-row" data-row>
        <div>
            <label>Label</label>
            <input class="form-control" type="text" data-name="primary_items[__INDEX__][label]">
        </div>
        <div>
            <label>Hyperlink</label>
            <input class="form-control" type="text" data-name="primary_items[__INDEX__][url]" value="#" placeholder="#section, /page, or https://...">
        </div>
        <label class="menu-check">
            <input type="hidden" data-name="primary_items[__INDEX__][has_dropdown]" value="0">
            <input type="checkbox" data-name="primary_items[__INDEX__][has_dropdown]" value="1">
            <span>Show arrow</span>
        </label>
        <button class="btn btn-outline-danger menu-remove" type="button">Delete</button>
    </div>
</template>

<template id="audience-row-template">
    <div class="menu-row" data-row>
        <div>
            <label>Label</label>
            <input class="form-control" type="text" data-name="audience_items[__INDEX__][label]">
        </div>
        <div>
            <label>Hyperlink</label>
            <input class="form-control" type="text" data-name="audience_items[__INDEX__][url]" value="#" placeholder="#section, /page, or https://...">
        </div>
        <label class="menu-check">
            <input type="hidden" data-name="audience_items[__INDEX__][is_active]" value="0">
            <input type="checkbox" data-name="audience_items[__INDEX__][is_active]" value="1">
            <span>Highlighted</span>
        </label>
        <button class="btn btn-outline-danger menu-remove" type="button">Delete</button>
    </div>
</template>

<style>
    .menu-rows {
        display: grid;
        gap: 14px;
    }
    .menu-row {
        display: grid;
        grid-template-columns: minmax(160px, 1fr) minmax(220px, 1.6fr) auto auto;
        align-items: end;
        gap: 14px;
        padding: 14px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #f8fafc;
    }
    .menu-check {
        display: inline-flex !important;
        align-items: center;
        gap: 8px;
        min-height: 46px;
        margin: 0 !important;
        white-space: nowrap;
    }
    .menu-check input {
        width: 18px;
        height: 18px;
    }
    @media (max-width: 991.98px) {
        .menu-row {
            grid-template-columns: 1fr;
            align-items: stretch;
        }
    }
</style>

<script>
    document.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.menu-remove');

        if (removeButton) {
            removeButton.closest('[data-row]').remove();
            return;
        }

        const addButton = event.target.closest('[data-add-row]');

        if (! addButton) {
            return;
        }

        const type = addButton.dataset.addRow;
        const target = document.getElementById(type + '-menu-rows');
        const template = document.getElementById(type + '-row-template');
        const index = Date.now();
        const fragment = template.content.cloneNode(true);

        fragment.querySelectorAll('[data-name]').forEach(function (input) {
            input.name = input.dataset.name.replace('__INDEX__', index);
            input.removeAttribute('data-name');
        });

        target.appendChild(fragment);
    });
</script>
@endsection
