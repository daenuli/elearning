<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('students');
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('school_classes')->onDelete('set null');
            $table->unsignedBigInteger('study_group_id')->nullable();
            $table->foreign('study_group_id')->references('id')->on('study_groups')->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('NISN_number')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('religion')->nullable();
            $table->string('road')->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
