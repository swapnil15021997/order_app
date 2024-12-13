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
        Schema::create('settings', function (Blueprint $table) {
            $table->id('setting_id'); 
            $table->string('setting_name');
            $table->text('setting_value')->nullable();
            $table->string('setting_status');
            $table->unsignedBigInteger('setting_expired')->nullable();
            $table->boolean('is_delete')->default(false);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
