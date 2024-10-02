<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenToFoodMakersTable extends Migration
{
    public function up()
    {
        Schema::table('food_makers', function (Blueprint $table) {
            $table->string('token')->nullable(); // Add the token field
        });
    }

    public function down()
    {
        Schema::table('food_makers', function (Blueprint $table) {
            $table->dropColumn('token'); // Drop the token field if rolling back
        });
    }
}
