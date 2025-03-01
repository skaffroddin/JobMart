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
        //
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('job_type_id'); 
            }
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('jobs', function (Blueprint $table) {
            // Drop foreign key and the user_id column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

    }
};
