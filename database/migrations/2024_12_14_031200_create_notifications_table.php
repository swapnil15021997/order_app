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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('noti_id'); 
            $table->unsignedBigInteger('noti_status')->comment('1=pending, 2=send,3=failed');
            $table->text('noti_user_ids')->nullable()->comment('comma seperated user ids'); 
            $table->unsignedBigInteger('noti_type')->nullable()->comment('1=order add, 2=order edit'); 
            $table->unsignedBigInteger('noti_order_id')->nullable()->comment('order id'); 
            $table->string('noti_title')->nullable()->comment('Title of notification');
            $table->text('noti_message')->nullable()->comment('Notification message');
            $table->text('noti_read_by')->nullable()->comment('comma seperated user ids');
            $table->text('noti_deleted_by')->nullable(); 
            $table->text('noti_failed_reason')->nullable(); 
            $table->boolean('is_delete')->default(false); 
            $table->timestamps(); // created_at and updated_at
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
