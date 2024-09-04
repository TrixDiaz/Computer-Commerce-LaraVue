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
        'stocks',
        'image',
        'hover_image',
        'category_id',
        'brand_id',
        'user_id',
        'series_id',
        'is_featured',
        'is_sale',
        'is_new',
        'is_active',
    ];
    
    protected $with = [
        'category',
        'brand',
        'user',
        'series',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }
}
