<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('attribute_value_product_attribute')) {
            Schema::create('attribute_value_product_attribute', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('attribute_value_id');
                $table->foreign('attribute_value_id')->references('id')->on('attribute_values');
                $table->unsignedBigInteger('product_attribute_id');
                $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_product_attribute');
    }
};
