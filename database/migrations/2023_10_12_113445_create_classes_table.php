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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('programme_id')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_deleted')->default(false);
            
            $table->foreign('created_by')->references('id')->on('users')->OnUpdate('cascade')->OnDelete('set null');
            $table->foreign('school_id')->references('id')->on('schools')->OnUpdate('cascade')->OnDelete('cascade');
            $table->foreign('programme_id')->references('id')->on('programmes')->OnUpdate('cascade')->OnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
