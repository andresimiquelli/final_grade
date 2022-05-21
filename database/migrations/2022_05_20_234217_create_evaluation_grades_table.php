<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id');
            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedTinyInteger('value');
            $table->timestamps();

            $table->foreign('evaluation_id')->references('id')->on('evaluations');
            $table->foreign('enrollment_id')->references('id')->on('enrollments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluation_grades', function(Blueprint $table) {
            $table->dropIndex('evaluation_grades_evaluation_id_foreign');
            $table->dropIndex('evaluation_grades_enrollment_id_foreign');
        });

        Schema::dropIfExists('evaluation_grades');
    }
}
