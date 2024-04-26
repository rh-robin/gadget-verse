<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock(){
        return $this->hasOne(ProductStock::class);
    }

    public function images()
    {
        return $this->hasMany(ProductMultiImage::class, 'product_variation_id');
    }
}
