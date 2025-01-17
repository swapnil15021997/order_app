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
        Schema::create('multiple_transfer', function (Blueprint $table) {
            $table->id('trans_id');
            $table->text('trans_ids')->comment("Comma seperated transaction IDs"); 
            $table->boolean('trans_status')->comment("Transaction status"); 
            $table->boolean('is_delete')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiple_transfer');
    }
};
