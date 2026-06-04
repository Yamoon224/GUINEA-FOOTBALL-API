<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('name_fr');
            $table->string('name_en');
            $table->string('category');
            $table->string('price');
            $table->string('image');
            $table->boolean('is_new')->default(false);
            $table->boolean('is_sale')->default(false);
            $table->string('old_price')->nullable();
            $table->unsignedTinyInteger('rating')->default(4);
            $table->unsignedSmallInteger('reviews')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
