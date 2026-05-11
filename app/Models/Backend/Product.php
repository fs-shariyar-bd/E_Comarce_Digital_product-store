<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use App\Models\Backend\ProductImage;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'product_details',
        'quantity',
        'price',
        'discount',
        'delivery_policy',
        'return_policy',
        'order',
        'status',
        'category_id',
        'sub_category_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function firstimage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->orderBy('order', 'asc');
    }
}