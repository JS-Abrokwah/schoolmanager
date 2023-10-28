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
            $table->foreignId('school_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('user_type');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_no');
            $table->string('sex');
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
