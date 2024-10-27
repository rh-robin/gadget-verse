<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    public function stocks(){
        return $this->hasMany(ProductStock::class);
    }
    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }

    public function images(){
        return $this->hasMany(ProductMultiImage::class);
    }

    public function product3dImage(){
        return $this->hasOne(Product3dImage::class);
    }

    public function productVideo(){
        return $this->hasOne(ProductVideo::class);
    }

    public function reviews(){
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }
    
}
