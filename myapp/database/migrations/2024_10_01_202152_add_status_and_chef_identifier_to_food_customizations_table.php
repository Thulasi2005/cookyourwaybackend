<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndChefIdentifierToFoodCustomizationsTable extends Migration
{
    public function up()
    {
        Schema::table('food_customizations', function (Blueprint $table) {
            $table->string('status')->default('Pending'); // Default status is Pending
            $table->string('chef_identifier')->nullable(); // Nullable chef identifier
        });
    }

    public function down()
    {
        Schema::table('food_customizations', function (Blueprint $table) {
            $table->dropColumn(['status', 'chef_identifier']);
        });
    }
}
