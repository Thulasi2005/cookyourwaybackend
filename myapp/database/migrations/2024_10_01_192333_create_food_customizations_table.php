<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodCustomizationsTable extends Migration
{
    public function up()
    {
        Schema::create('food_customizations', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->integer('quantity');
            $table->string('portion_size');
            $table->text('food_description');
            $table->string('price_range');
            $table->string('address');
            $table->string('delivery_method');
            $table->string('identifier'); // To store the identifier
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_customizations');
    }
}
