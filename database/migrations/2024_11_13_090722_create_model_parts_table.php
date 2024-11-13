<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_parts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("jewelry_model_id")->unsigned();
            $table->bigInteger("part_id")->unsigned();
            $table->integer('quantity')->default(1);
            $table->double('unit_price');
            $table->double('total_price');
            $table->double('unit_weight');
            $table->double('total_weight');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('jewelry_model_id')->references('id')->on('jewelry_models');
            $table->foreign('part_id')->references('id')->on('parts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_parts');
    }
};
