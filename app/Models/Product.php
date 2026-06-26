<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'marked_price',
        'quantity',
        'subcategory',
        'google_merchant',
        'image',
        'meta_description',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'marked_price' => 'decimal:2',
            'quantity' => 'integer',
            'google_merchant' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
