<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku',
        'name',
        'category',
        'price',
        'stock'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function getStockStatusAttribute()
    {
        if ($this->stock > 5) {
            return 'In Stock';
        } elseif ($this->stock >= 1) {
            return 'Low Stock';
        } else {
            return 'Out of Stock';
        }
    }
}
