<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'nama_products',
        'totalPrice',
        'description',
    ];

    public function galleries(): HasMany
    {
        return $this->hasMany(ProductsGallery::class, 'products_id');
    }
}
