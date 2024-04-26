<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Color;

class ColorController extends Controller
{
    public function view(){
        $colors = Color::all();
        return view("backend.color.color_view", compact("colors"));
    }
}
