<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsGallery extends Model
{
    protected $fillable = [
        'products_id',
        'image',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
