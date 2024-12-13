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
        Schema::create('email_log', function (Blueprint $table) {
            $table->id('mail_id'); // Primary key
            $table->unsignedBigInteger('mail_order_id')->comment('Order ID'); 
            $table->string('mail_from')->comment('Sender email'); 
            $table->string('mail_to')->comment('Receivers emil'); 
            $table->string('mail_cc')->nullable()->comment('CC Email Address'); 
            $table->string('mail_bcc')->nullable()->comment('BCC Email Address'); 
            $table->string('mail_subject')->comment('Email subject'); 
            $table->text('mail_content')->comment('The content of the email');
            $table->unsignedBigInteger('mail_status')->comment('Status of the mail 1=>sent 2=">pending")'); 
            $table->boolean('is_deleted')->default(false); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_log');
    }
};
