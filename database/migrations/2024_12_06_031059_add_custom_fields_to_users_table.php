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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name', 256)->comment('Name of the user');
            $table->string('user_phone_number', 256)->unique()->comment('Phone number of the user');
            $table->text('user_address')->nullable()->comment('Address of the user');
            $table->string('user_sweetword', 256)->nullable()->comment('Sweetword pass of the user');
            $table->string('user_module_id', 256)->nullable()->comment('Module ids');
            $table->string('user_permission_id', 256)->nullable()->comment('Permission ids');
            $table->unsignedBigInteger('user_role_id')->nullable()->comment('Role id');
            $table->boolean('is_delete')->default(false)->comment('Soft delete flag');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->text('session_token')->nullable()->comment('Session token');
            $table->text('session_fcm_token')->nullable()->comment('User Fcm token');
            $table->text('session_user_device')->nullable()->comment('User device type');
            $table->integer('session_expiry_time_stamp')->comment('Sessions expiration time');
            $table->integer('session_status');
            $table->boolean('session_is_delete')->detault(false);
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', 255)->comment('role name');
            $table->integer('role_status')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_name',
                'user_phone_number',
                'user_address',
                'user_sweetword',
                'user_module_id',
                'user_permission_id',
                'is_delete',
            ]);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn([

                'session_token',
                'session_fcm_token',
                'session_user_device',
                'session_expiry_time_stamp',
                'session_status',
                'session_is_delete'
            ]);
        });

        Schema::dropIfExists('user_roles');
   
    }
};
