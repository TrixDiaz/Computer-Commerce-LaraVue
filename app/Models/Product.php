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
        'stock',
        'image',
        'category_id',
        'brand_id',
        'user_id',
        'is_featured',
        'is_sale',
        'is_new',
        'is_active',
    ];

    protected $with = [
        'category',
        'brand',
        'user'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
