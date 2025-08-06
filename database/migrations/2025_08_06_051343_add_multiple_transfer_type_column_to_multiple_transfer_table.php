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
        Schema::table('multiple_transfer', function (Blueprint $table) {
            $table->string('multiple_transfer_delivery_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiple_transfer', function (Blueprint $table) {
            
            $table->dropColumn('multiple_transfer_delivery_note');
        });
    }
};
