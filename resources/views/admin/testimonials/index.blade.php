@extends('layouts.dashboard')

@section('title', 'Testimonials')
@section('dashboard-title', 'Testimonials')
@section('dashboard-subtitle', 'Manage customer testimony content.')
@section('dashboard-actions')
    <a class="btn btn-primary rounded-pill fw-semibold px-4" href="{{ route('admin.testimonials.create') }}"><i class="bi bi-plus-lg"></i> Add Testimony</a>
@endsection

@section('content')
<div class="px-3 pb-4">
    <div class="card dashboard-content-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Testimony</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->location ?: '-' }}</td>
                            <td>{{ $testimonial->testimony }}</td>
                            <td>{{ $testimonial->created_at?->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <a class="btn btn-sm btn-outline-primary rounded-pill" href="{{ route('admin.testimonials.edit', $testimonial) }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    <form method="post" action="{{ route('admin.testimonials.destroy', $testimonial) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill w-100" type="submit" onclick="return confirm('Delete this testimony?')"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No testimonials found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $testimonials->links() }}</div>
</div>
@endsection
