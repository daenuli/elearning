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
        Schema::create('assessment_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('assessment_id')->constrained('assessments')->onDelete('cascade');
            $table->enum('status', ['Not Started', 'In Progress', 'Completed'])->default('Not Started');
            $table->boolean('is_graded')->default(false);
            $table->tinyInteger('marks_obtained')->default(0);
            $table->timestamp('submitted_at')->nullable();
            $table->decimal('time_spent', 6,2)->default(0)->comment('Time spent will be in minutes');
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
        Schema::dropIfExists('assessment_student');
    }
};
