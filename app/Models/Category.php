<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'meta_description', 'icon', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
