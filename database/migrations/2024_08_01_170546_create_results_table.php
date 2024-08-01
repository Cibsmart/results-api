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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->index();
            $table->string('session');
            $table->string('semester');
            $table->string('course_code');
            $table->string('course_title');
            $table->string('credit_unit');
            $table->string('in_course')->nullable();
            $table->string('exam')->nullable();
            $table->string('total')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
