<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('payment_order_id')->comment('Payment order id'); 
            $table->float('payment_booking_rate', 15, 2)->comment('Booking Rate'); 
            $table->unsignedBigInteger('payment_customer_id'); 
            $table->float('payment_advance_cash', 15, 2)->comment('Advance'); 
            $table->date('payment_date')->comment('Date of Payment'); 
            $table->boolean('is_delete')->default(false); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
