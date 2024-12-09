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
        Schema::create('notes', function (Blueprint $table) {
            $table->id('notes_id'); 
            $table->text('notes_text')->nullable()->comment('Text content of the note');
            $table->unsignedBigInteger('notes_type')->comment('1-Text, 2-File, 3-audio');
            $table->unsignedBigInteger('notes_file_id')->nullable()->comment('File ID associated with the note');
            $table->boolean('is_delete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
