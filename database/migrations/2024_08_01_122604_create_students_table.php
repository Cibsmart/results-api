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
            $table->string('last_name');
            $table->string('first_name');
            $table->string('other_names')->nullable();
            $table->string('registration_number');
            $table->enum('gender', ['M', 'F']);
            $table->string('date_of_birth')->nullable();
            $table->foreignId('department_id')->constrained('departments');
            $table->string('option')->nullable();
            $table->string('state')->nullable();
            $table->string('local_government')->nullable();
            $table->string('entry_session')->nullable();
            $table->string('entry_mode')->nullable();
            $table->string('entry_level')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
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
