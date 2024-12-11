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
            $table->string('user_branch_ids')->nullable()->after('email'); // Nullable string for branch IDs
            $table->unsignedBigInteger('user_active_branch')->nullable()->after('user_branch_ids'); // Nullable foreign key for active branch
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_branch_ids');
            $table->dropColumn('user_active_branch');
        });
    }
};
