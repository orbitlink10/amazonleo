@extends('layouts.dashboard')
@section('title', 'Homepage Content')
@section('dashboard-title', '')
@section('dashboard-subtitle', '')
@section('content')
@php
    $currentHeroImage = $content['home_hero_image'];
    $currentHeroImageUrl = str_starts_with($currentHeroImage, 'http') ? $currentHeroImage : asset('storage/'.$currentHeroImage);
@endphp

<div class="adminlte-content-wrapper">
    <section class="adminlte-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Homepage Content</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update Content</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="adminlte-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Homepage Content Management</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="home_hero_title">Hero Header Title</label>
                                    <input type="text" class="form-control" name="home_hero_title" value="{{ old('home_hero_title', $content['home_hero_title']) }}" id="home_hero_title" placeholder="Hero header title" required>
                                </div>

                                <div class="form-group">
                                    <label for="home_hero_description">Hero Header Description</label>
                                    <textarea class="form-control" name="home_hero_description" id="home_hero_description" required>{{ old('home_hero_description', $content['home_hero_description']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_hero_image">Hero Image (1280 x 720)</label>
                                    <input type="file" class="form-control" name="home_hero_image" id="home_hero_image" accept="image/*">
                                    <input type="hidden" name="home_hero_image_url" value="{{ old('home_hero_image_url', str_starts_with($content['home_hero_image'], 'http') ? $content['home_hero_image'] : '') }}">
                                    <img src="{{ $currentHeroImageUrl }}" alt="Current hero image" class="homepage-content-image">
                                </div>

                                <div class="form-group">
                                    <label for="home_why_title">Why Choose Title</label>
                                    <input type="text" class="form-control" name="home_why_title" value="{{ old('home_why_title', $content['home_why_title']) }}" id="home_why_title" required>
                                </div>

                                <div class="form-group">
                                    <label for="home_why_text">Why Choose Description</label>
                                    <textarea class="form-control" name="home_why_text" id="home_why_text" required>{{ old('home_why_text', $content['home_why_text']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_services_title">Products Section Title</label>
                                    <input type="text" class="form-control" name="home_services_title" value="{{ old('home_services_title', $content['home_services_title']) }}" id="home_services_title" required>
                                </div>

                                <div class="form-group">
                                    <label for="home_services_subtitle">Products Section Subtitle</label>
                                    <input type="text" class="form-control" name="home_services_subtitle" value="{{ old('home_services_subtitle', $content['home_services_subtitle']) }}" id="home_services_subtitle">
                                </div>

                                <div class="form-group">
                                    <label for="home_page_description">Home Page Content</label>
                                    <textarea id="home_page_description" name="home_areas_text" rows="14" required>{{ old('home_areas_text', $content['home_areas_text']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="about">About Us</label>
                                    <textarea id="about" name="home_empty_testimonials" rows="10" required>{{ old('home_empty_testimonials', $content['home_empty_testimonials']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="faq">FAQ</label>
                                    <textarea id="faq" name="home_testimonials_title" rows="8" required>{{ old('home_testimonials_title', $content['home_testimonials_title']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="terms">Terms</label>
                                    <textarea id="terms" name="home_video_url" rows="8">{{ old('home_video_url', $content['home_video_url']) }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="home_primary_cta">Primary CTA Label</label>
                                            <input type="text" class="form-control" name="home_primary_cta" value="{{ old('home_primary_cta', $content['home_primary_cta']) }}" id="home_primary_cta" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="home_provider_cta">Provider CTA Label</label>
                                            <input type="text" class="form-control" name="home_provider_cta" value="{{ old('home_provider_cta', $content['home_provider_cta']) }}" id="home_provider_cta" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="home_whatsapp_cta">WhatsApp CTA Label</label>
                                            <input type="text" class="form-control" name="home_whatsapp_cta" value="{{ old('home_whatsapp_cta', $content['home_whatsapp_cta']) }}" id="home_whatsapp_cta" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="home_whatsapp_url">WhatsApp URL</label>
                                    <input type="text" class="form-control" name="home_whatsapp_url" value="{{ old('home_whatsapp_url', $content['home_whatsapp_url']) }}" id="home_whatsapp_url" required>
                                </div>

                                <div class="row">
                                    @for($i = 1; $i <= 3; $i++)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="home_how_title_{{ $i }}">Step {{ $i }} Title</label>
                                                <input type="text" class="form-control" name="home_how_title_{{ $i }}" value="{{ old('home_how_title_'.$i, $content['home_how_title_'.$i]) }}" id="home_how_title_{{ $i }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="home_how_text_{{ $i }}">Step {{ $i }} Text</label>
                                                <textarea class="form-control" name="home_how_text_{{ $i }}" id="home_how_text_{{ $i }}" rows="4" required>{{ old('home_how_text_'.$i, $content['home_how_text_'.$i]) }}</textarea>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <div class="form-group">
                                    <label for="home_areas_title">Areas Title</label>
                                    <input type="text" class="form-control" name="home_areas_title" value="{{ old('home_areas_title', $content['home_areas_title']) }}" id="home_areas_title" required>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a class="btn btn-outline-primary ms-2" href="{{ route('home') }}" target="_blank">View Homepage</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .homepage-content-image {
        display: block;
        max-width: 100%;
        max-height: 260px;
        object-fit: cover;
        margin-top: 12px;
    }
</style>
@endsection
