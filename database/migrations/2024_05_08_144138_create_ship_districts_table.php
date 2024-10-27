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
        Schema::create('ship_districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')->references('id')->on('ship_divisions')->onDelete('cascade');
            $table->string('district_name')->unique();
            $table->integer('shipping_charge')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_districts');
    }
};
