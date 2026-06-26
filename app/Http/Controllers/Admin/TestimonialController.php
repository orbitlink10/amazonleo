<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('admin.testimonials.index', [
            'reviews' => Review::with(['customer', 'provider', 'booking'])->latest()->paginate(20),
        ]);
    }
}
