<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("jewelery_model_id")->unsigned();
            $table->bigInteger("category_id")->unsigned();
            $table->string('title');
            $table->double('price');
            $table->double('compare_price');
            $table->text('description')->nullable();

            $table->string('image');
            $table->string('secondary_image_1');
            $table->string('secondary_image_2');
            $table->string('secondary_image_3');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('jewelery_model_id')->references('id')->on('jewelery_models');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
