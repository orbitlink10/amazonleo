@extends('layouts.dashboard')

@section('title', 'Testimonials')
@section('dashboard-title', 'Testimonials')
@section('dashboard-subtitle', 'Customer reviews and testimonial content.')

@section('content')
<div class="px-3 pb-4">
    <div class="card dashboard-content-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Provider</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->customer->name ?? '-' }}</td>
                            <td>{{ $review->provider->name ?? '-' }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>{{ $review->comment ?: '-' }}</td>
                            <td>{{ $review->created_at?->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No testimonials found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $reviews->links() }}</div>
</div>
@endsection
