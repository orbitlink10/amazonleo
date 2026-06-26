<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Booking::with(['customer', 'category', 'service', 'provider'])
                ->latest()
                ->paginate(20),
        ]);
    }
}
