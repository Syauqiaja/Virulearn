<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* turn off foreign key checks for a moment */
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        /* set null values to 0 first */
        DB::statement('UPDATE `exams` SET `activity_id` = 0 WHERE `user_id` IS NULL;');
        /* alter table */
        DB::statement('ALTER TABLE `exams` MODIFY `activity_id` INTEGER UNSIGNED NOT NULL;');
        /* finally turn foreign key checks back on */
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
