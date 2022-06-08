<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_assignments', function(Blueprint $table) {
            $table->dropIndex('teacher_assignments_teacher_id_foreign');
            $table->dropIndex('teacher_assignments_class_id_foreign');
            $table->dropIndex('teacher_assignments_subject_id_foreign');
        });

        Schema::dropIfExists('teacher_assignments');
    }
}
