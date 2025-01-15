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
        Schema::table('temp_orders', function (Blueprint $table) {
            $table->text('temp_notes_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('temp_notes_id')->nullable()->change();
        });
    }
};
