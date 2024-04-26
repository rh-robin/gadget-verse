<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        "color_name_en",
        "color_name_bn",
        "color_slug_en",
        "color_slug_bn",
        "color_code",
        "color_status"
    ] ;
}
