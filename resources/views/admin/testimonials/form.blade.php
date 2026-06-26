@extends('layouts.dashboard')

@section('title', $testimonial->exists ? 'Edit Testimony' : 'Add Testimony')
@section('dashboard-title', $testimonial->exists ? 'Edit Testimony' : 'Add Testimony')
@section('dashboard-subtitle', '')

@section('content')
<div class="px-3 pb-4">
    <div class="card dashboard-content-card">
        <div class="card-body">
            <form method="post" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
                @csrf
                @if($testimonial->exists) @method('put') @endif
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name</label>
                        <input class="form-control" name="name" value="{{ old('name', $testimonial->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Location</label>
                        <input class="form-control" name="location" value="{{ old('location', $testimonial->location) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Testimony</label>
                        <textarea class="form-control" name="testimony" rows="6" required>{{ old('testimony', $testimonial->testimony) }}</textarea>
                    </div>
                </div>
                <button class="btn btn-primary rounded-pill mt-3 px-4">Save Testimony</button>
                <a class="btn btn-outline-secondary rounded-pill mt-3 px-4" href="{{ route('admin.testimonials.index') }}">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
