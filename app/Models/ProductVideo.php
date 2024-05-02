<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'embed_code',
        'video_source',
        'video_priority',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
