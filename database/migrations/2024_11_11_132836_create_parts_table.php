<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('type');

            $table->string('name');
            $table->string('size');
            $table->double('gr_pcs');
            $table->double('dollar_gr');
            $table->double('dollar_pcs');
            $table->string('group');
            $table->string('mcode');
            $table->bigInteger("reseller_id")->unsigned();
            $table->string('reseller_barcode');
            $table->string('image');


            // stones
            $table->boolean('faceted')->nullable();
            $table->string('color')->nullable();
            $table->double('stone_pack')->nullable();

            // chains
            $table->boolean('role')->nullable();
            $table->double('thickness')->nullable();
            $table->double('gr_dm')->nullable();

            $table->timestamps();
            $table->foreign('reseller_id')->references('id')->on('resellers');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
