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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('admin_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('classes_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->date('date_of_birth');
            $table->date('admission_date');
            $table->string('admission_number');
            $table->string('index_number');
            $table->string('roll_number');
            $table->string('programme_of_study');
            $table->string('residence');//Day or Boarder
            $table->string('house');//House of Affiliation
            $table->string('last_school_attended');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
