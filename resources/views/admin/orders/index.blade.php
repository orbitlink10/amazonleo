@extends('layouts.dashboard')

@section('title', 'Orders')
@section('dashboard-title', 'Orders')
@section('dashboard-subtitle', 'Details of orders placed by customers.')

@section('content')
<div class="px-3 pb-4">
    <div class="card dashboard-content-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order No.</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Category</th>
                        <th>Service</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->booking_number }}</td>
                            <td>{{ $order->customer->name ?? '-' }}</td>
                            <td>{{ $order->customer->phone ?? '-' }}</td>
                            <td>{{ $order->category->name ?? '-' }}</td>
                            <td>{{ $order->service->name ?? '-' }}</td>
                            <td>{{ $order->location }}</td>
                            <td>{{ $order->preferred_date?->format('M d, Y') }} {{ $order->preferred_time }}</td>
                            <td>KES {{ number_format((float) $order->estimated_price, 2) }}</td>
                            <td class="text-capitalize">{{ str_replace('_', ' ', $order->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted py-4">No orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $orders->links() }}</div>
</div>
@endsection
