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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cust_id');
            $table->string('cust_name')->comment('Name of the customer');
            $table->text('cust_address')->comment('Address of the customer');
            $table->string('cust_phone_no', 15)->comment('Contact of the customer');
            $table->boolean('is_delete')->default(false); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
