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
        
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('trans_id');
            $table->unsignedBigInteger('trans_from');
            $table->unsignedBigInteger('trans_to');
            $table->unsignedBigInteger('trans_active_branch');
            $table->unsignedBigInteger('trans_user_id');
            $table->unsignedBigInteger('trans_order_id');
            $table->unsignedBigInteger('trans_item_id');
            $table->date('trans_date');
            $table->timestamp('trans_time')->useCurrent();
            $table->timestamps();
            $table->boolean('is_delete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
