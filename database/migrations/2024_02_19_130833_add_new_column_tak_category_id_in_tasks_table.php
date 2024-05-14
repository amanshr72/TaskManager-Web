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
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('task_category_id')->nullable()->index()->after('id');
            $table->boolean('is_important')->default(0)->after('remark');
            $table->dateTime('due_date')->nullable()->after('is_important');
            $table->string('recurrence', 50)->nullable()->after('due_date');
            $table->boolean('is_processed')->after('recurrence');
            $table->string('reminder', 50)->nullable()->after('is_processed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'task_category_id',
                'is_important',
                'due_date',
                'recurrence',
                'reminder'
            ]);
        });
    }
};
