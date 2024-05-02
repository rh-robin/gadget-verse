<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product3d_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('image_source');
            $table->string('background')->default('0xffffff');
            $table->float('scale_x')->default(0.04);
            $table->float('scale_y')->default(0.04);
            $table->float('scale_z')->default(0.04);
            $table->string('directional_light_color')->default('0xffffff');
            $table->float('directional_light_opacity')->default(5);
            $table->string('ambient_light_color')->default('0xffffff');
            $table->float('ambient_light_opacity')->default(3);
            $table->float('target_x')->default(0);
            $table->float('target_y')->default(1);
            $table->float('target_z')->default(0);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product3d_images');
    }
};
