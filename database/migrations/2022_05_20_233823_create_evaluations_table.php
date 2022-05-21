<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('pack_module_subject_id');
            $table->string('name',191);
            $table->unsignedTinyInteger('value')->default(0);
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('pack_module_subject_id')->references('id')->on('pack_module_subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function(Blueprint $table) {
            $table->dropIndex('evaluations_teacher_id_foreign');
            $table->dropIndex('evaluations_class_id_foreign');
            $table->dropIndex('evaluations_pack_module_subject_id_foreign');
        });

        Schema::dropIfExists('evaluations');
    }
}
