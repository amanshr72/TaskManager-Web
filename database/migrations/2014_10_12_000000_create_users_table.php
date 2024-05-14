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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_group', 100)->nullable();
            $table->string('name', 100);
            $table->string('role', 90)->comment('user_type');
            $table->string('email', 255)->unique();
            $table->string('phone', 12)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', ['Disabled', 'Enabled']);
            $table->string('password');
            $table->integer('group_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
