@extends('layouts.dashboard')
@section('title', 'Homepage Content')
@section('dashboard-title', '')
@section('dashboard-subtitle', '')
@section('content')
@php
    $homepageImageUrl = function (?string $image): string {
        $image = trim((string) $image);

        if ($image === '') {
            return 'https://via.placeholder.com/1280x720?text=Homepage+Image';
        }

        $path = parse_url($image, PHP_URL_PATH);
        $host = parse_url($image, PHP_URL_HOST);
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
        $requestHost = request()->getHost();

        if (is_string($path) && str_starts_with($path, '/storage/') && $host && in_array($host, array_filter([$appHost, $requestHost]), true)) {
            return route('pages.image', ['path' => str_replace('storage/', '', ltrim($path, '/'))]);
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '//')) {
            return $image;
        }

        if (str_starts_with($image, '/storage/')) {
            return route('pages.image', ['path' => str_replace('storage/', '', ltrim($image, '/'))]);
        }

        if (str_starts_with($image, 'storage/')) {
            return route('pages.image', ['path' => str_replace('storage/', '', $image)]);
        }

        return route('pages.image', ['path' => ltrim($image, '/')]);
    };

    $currentHeroImage = $content['home_hero_image'];
    $currentHeroImageUrl = $homepageImageUrl($currentHeroImage);
    $currentFeatureImage = $content['home_feature_image'];
    $currentFeatureImageUrl = $homepageImageUrl($currentFeatureImage);
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

                                <h4 class="homepage-section-title">Header</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="home_site_brand">Brand Text</label>
                                            <input type="text" class="form-control" name="home_site_brand" value="{{ old('home_site_brand', $content['home_site_brand']) }}" id="home_site_brand" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="home_phone">Phone Number</label>
                                            <input type="text" class="form-control" name="home_phone" value="{{ old('home_phone', $content['home_phone']) }}" id="home_phone" required>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="homepage-section-title">Hero</h4>
                                <div class="form-group">
                                    <label for="home_hero_title">Hero Header Title</label>
                                    <textarea class="form-control" name="home_hero_title" id="home_hero_title" rows="4" required>{{ old('home_hero_title', $content['home_hero_title']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_hero_description">Hero Header Description</label>
                                    <textarea class="form-control" name="home_hero_description" id="home_hero_description" required>{{ old('home_hero_description', $content['home_hero_description']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_hero_image">Hero Image (1280 x 720)</label>
                                    <input type="file" class="form-control" name="home_hero_image" id="home_hero_image" accept="image/*">
                                    <input type="text" class="form-control mt-2" name="home_hero_image_url" value="{{ old('home_hero_image_url', $content['home_hero_image']) }}" placeholder="Or paste an image URL">
                                    <small class="text-muted">Current value: {{ $content['home_hero_image'] ?: 'No image saved yet' }}</small>
                                    <img src="{{ $currentHeroImageUrl }}" alt="Current hero image" class="homepage-content-image">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="home_price_label">Price Label</label>
                                            <input type="text" class="form-control" name="home_price_label" value="{{ old('home_price_label', $content['home_price_label']) }}" id="home_price_label" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="home_price_amount">Price Amount</label>
                                            <input type="text" class="form-control" name="home_price_amount" value="{{ old('home_price_amount', $content['home_price_amount']) }}" id="home_price_amount" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="home_price_unit">Price Unit</label>
                                            <input type="text" class="form-control" name="home_price_unit" value="{{ old('home_price_unit', $content['home_price_unit']) }}" id="home_price_unit" required>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="homepage-section-title">Kit Cards</h4>

                                <div class="form-group">
                                    <label for="home_services_title">Products Section Title</label>
                                    <textarea class="form-control" name="home_services_title" id="home_services_title" rows="2" required>{{ old('home_services_title', $content['home_services_title']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_services_subtitle">Products Section Subtitle</label>
                                    <input type="text" class="form-control" name="home_services_subtitle" value="{{ old('home_services_subtitle', $content['home_services_subtitle']) }}" id="home_services_subtitle">
                                </div>

                                <div class="row">
                                    @for($i = 1; $i <= 3; $i++)
                                        <div class="col-md-4">
                                            <div class="homepage-mini-card">
                                                <div class="form-group">
                                                    <label for="home_kit_title_{{ $i }}">Kit {{ $i }} Title</label>
                                                    <input type="text" class="form-control" name="home_kit_title_{{ $i }}" value="{{ old('home_kit_title_'.$i, $content['home_kit_title_'.$i]) }}" id="home_kit_title_{{ $i }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_kit_text_{{ $i }}">Kit {{ $i }} Description</label>
                                                    <textarea class="form-control" name="home_kit_text_{{ $i }}" id="home_kit_text_{{ $i }}" rows="4" required>{{ old('home_kit_text_'.$i, $content['home_kit_text_'.$i]) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_kit_price_{{ $i }}">Kit {{ $i }} Price</label>
                                                    <input type="text" class="form-control" name="home_kit_price_{{ $i }}" value="{{ old('home_kit_price_'.$i, $content['home_kit_price_'.$i]) }}" id="home_kit_price_{{ $i }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <h4 class="homepage-section-title">Feature Band</h4>
                                <div class="form-group">
                                    <label for="home_feature_title">Feature Title</label>
                                    <textarea class="form-control" name="home_feature_title" id="home_feature_title" rows="3" required>{{ old('home_feature_title', $content['home_feature_title']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_feature_text">Feature Text</label>
                                    <textarea class="form-control" name="home_feature_text" id="home_feature_text" rows="3" required>{{ old('home_feature_text', $content['home_feature_text']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_feature_image">Feature Image</label>
                                    <input type="file" class="form-control" name="home_feature_image" id="home_feature_image" accept="image/*">
                                    <input type="text" class="form-control mt-2" name="home_feature_image_url" value="{{ old('home_feature_image_url', $content['home_feature_image']) }}" placeholder="Or paste an image URL">
                                    <small class="text-muted">Current value: {{ $content['home_feature_image'] ?: 'No image saved yet' }}</small>
                                    <img src="{{ $currentFeatureImageUrl }}" alt="Current feature image" class="homepage-content-image">
                                </div>

                                <h4 class="homepage-section-title">Why Choose / Service Intro</h4>
                                <div class="form-group">
                                    <label for="home_why_title">Why Choose Title</label>
                                    <input type="text" class="form-control" name="home_why_title" value="{{ old('home_why_title', $content['home_why_title']) }}" id="home_why_title" required>
                                </div>

                                <div class="form-group">
                                    <label for="home_why_text">Why Choose Description</label>
                                    <textarea class="form-control" name="home_why_text" id="home_why_text" rows="4" required>{{ old('home_why_text', $content['home_why_text']) }}</textarea>
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

                                <h4 class="homepage-section-title">Process</h4>
                                <div class="row">
                                    @for($i = 1; $i <= 4; $i++)
                                        <div class="col-md-3">
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

                                <h4 class="homepage-section-title">CTA and Long Content</h4>
                                <div class="form-group">
                                    <label for="home_areas_title">CTA Title</label>
                                    <input type="text" class="form-control" name="home_areas_title" value="{{ old('home_areas_title', $content['home_areas_title']) }}" id="home_areas_title" required>
                                </div>

                                <div class="form-group">
                                    <label for="home_areas_text">CTA Text</label>
                                    <textarea class="form-control" name="home_areas_text" id="home_areas_text" rows="3" required>{{ old('home_areas_text', $content['home_areas_text']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_testimonials_title">Long Content Section Title</label>
                                    <input type="text" class="form-control" name="home_testimonials_title" value="{{ old('home_testimonials_title', $content['home_testimonials_title']) }}" id="home_testimonials_title" required>
                                </div>

                                <div class="form-group">
                                    <label for="home_empty_testimonials">Long Homepage Content</label>
                                    <textarea id="home_empty_testimonials" class="homepage-rich-editor" name="home_empty_testimonials" rows="18" required>{{ old('home_empty_testimonials', $content['home_empty_testimonials']) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="home_footer_text">Footer Text</label>
                                    <input type="text" class="form-control" name="home_footer_text" value="{{ old('home_footer_text', $content['home_footer_text']) }}" id="home_footer_text" required>
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
    .homepage-section-title {
        margin: 28px 0 14px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e2e8f0;
        color: #0f172a;
        font-size: 1.1rem;
        font-weight: 700;
    }
    .homepage-mini-card {
        height: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        background: #f8fafc;
    }
    .tox-tinymce {
        border-color: #e2e8f0 !important;
        border-radius: 12px !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
            selector: '#home_empty_testimonials',
            license_key: 'gpl',
            base_url: 'https://cdn.jsdelivr.net/npm/tinymce@7',
            suffix: '.min',
            height: 620,
            menubar: 'file edit view insert format tools table',
            plugins: 'advlist autolink charmap code fullscreen image link lists media preview table visualblocks wordcount',
            toolbar: [
                'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify',
                'bullist numlist outdent indent | link image media | table | code fullscreen'
            ].join(' | '),
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4',
            image_title: true,
            image_advtab: true,
            media_live_embeds: true,
            convert_urls: false,
            relative_urls: false,
            remove_script_host: false,
            extended_valid_elements: 'iframe[src|width|height|name|align|class|style|frameborder|allow|allowfullscreen|loading|referrerpolicy],video[*],source[*],img[*]',
            valid_children: '+body[style|iframe|video]',
            content_style: [
                'body{font-family:Arial,Helvetica,sans-serif;font-size:18px;line-height:1.65;color:#17202a;padding:20px;}',
                'h1{font-size:34px;line-height:1.15;margin:0 0 20px;}',
                'h2{font-size:28px;line-height:1.2;margin:28px 0 12px;}',
                'h3{font-size:22px;line-height:1.25;margin:22px 0 10px;}',
                'p{margin:0 0 16px;}',
                'img,video,iframe{max-width:100%;}',
                'table{border-collapse:collapse;width:100%;}',
                'td,th{border:1px solid #dbe3ea;padding:8px;}'
            ].join('')
        });
    });
</script>
@endsection
