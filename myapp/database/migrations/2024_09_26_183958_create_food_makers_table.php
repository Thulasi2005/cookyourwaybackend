<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodMakersTable extends Migration
{
    public function up()
    {
        Schema::create('food_makers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('business_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password'); // We'll use hashing for passwords
            $table->text('address');
            $table->text('bio');
            $table->json('cuisine_specialties')->nullable(); // Store as JSON
            $table->string('delivery_options'); // 'Delivery' or 'Takeaway'
            $table->string('profile_picture')->nullable();
            $table->string('certification')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_makers');
    }
}
