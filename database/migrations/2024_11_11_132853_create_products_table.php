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
            $table->bigInteger("jewelry_model_id")->unsigned()->nullable();
            $table->bigInteger("category_id")->unsigned();
            $table->string('title');
            $table->string('mcode');
            $table->double('karat');
            $table->double('weight');
            $table->double('price');
            $table->double('compare_price')->nullable();
            $table->text('description')->nullable();

            $table->string('image');
            $table->string('secondary_image_1')->nullable();
            $table->string('secondary_image_2')->nullable();
            $table->string('secondary_image_3')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('jewelry_model_id')->references('id')->on('jewelry_models');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
