<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',
        'vendor_id',
        'name',
        'slug',
        'code',
        'tags',
        'qty',
        'short_descp',
        'long_descp',
        'size',
        'color',
        'selling_price',
        'discount_price',
        'thambnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status',
    ];
}
