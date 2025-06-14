<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'email',
        'nama_pemesan',
        'no_hp',
        'day_start',
        'day_end',
        'proof',
        'products_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function getDayStartFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->day_start)->format('d F Y');
    }
    public function getDayEndFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->day_end)->format('d F Y');
    }
}
