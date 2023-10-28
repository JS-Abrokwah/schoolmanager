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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('created_by');
            $table->string('name');
            $table->string('certification')->default('WASSCE'); //WASSCE, NVTI, HND, Diploma, etc
            $table->string('description');
            $table->string('specialization'); // Science, Business, Vocational, Technical, IT, Arts,etc
            $table->boolean('status'); // 1 for active, 0 for inactive
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
