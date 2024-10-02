<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('order_id'); // Order ID associated with the payment
            $table->decimal('amount', 10, 2); // Amount paid
            $table->string('payment_method'); // Payment method (Cash/Card)
            $table->string('card_holder_name')->nullable(); // Cardholder name (if applicable)
            $table->string('card_number')->nullable(); // Card number (if applicable)
            $table->string('expiry_date')->nullable(); // Expiry date (if applicable)
            $table->string('cvc')->nullable(); // CVC (if applicable)
            $table->timestamps(); // Created_at and Updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
