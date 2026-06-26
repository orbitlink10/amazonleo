@extends('layouts.dashboard')

@section('title', 'Customers')
@section('dashboard-title', 'Customers')
@section('dashboard-subtitle', 'Customer details captured in the system.')

@section('content')
<div class="px-3 pb-4">
    <div class="card dashboard-content-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>County</th>
                        <th>Location</th>
                        <th>Orders</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?: '-' }}</td>
                            <td>{{ $customer->county ?: '-' }}</td>
                            <td>{{ $customer->location ?: '-' }}</td>
                            <td>{{ $customer->bookings_count }}</td>
                            <td>{{ $customer->created_at?->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No customers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $customers->links() }}</div>
</div>
@endsection
