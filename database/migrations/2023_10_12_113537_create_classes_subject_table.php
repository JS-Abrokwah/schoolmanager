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
        Schema::create('classes_subject', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('subject_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('classes_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            
            $table->boolean('active')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes_subject');
    }
};
