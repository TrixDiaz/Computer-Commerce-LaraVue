<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sale_price',
        'category_id',
        'brand_id',
        'user_id',
        'stock',
        'image',
        'is_active',
        'is_featured',
        'is_sale',
        'is_new_product',
    ];

    protected $with = [
        'category',
        'brand',
        'user'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->where('is_active', true);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->where('is_active', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
