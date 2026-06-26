<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers.index', [
            'customers' => User::with('role')
                ->withCount('bookings')
                ->whereHas('role', fn ($query) => $query->where('name', 'customer'))
                ->latest()
                ->paginate(20),
        ]);
    }
}
