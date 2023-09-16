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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('education')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('religion')->nullable();
            $table->string('appointment_decree')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('teachers');
    }
};
