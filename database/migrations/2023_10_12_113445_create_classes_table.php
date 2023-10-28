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
            $table->foreignId('created_by')->nullable()->constrained('users','id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('school_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('programme_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
