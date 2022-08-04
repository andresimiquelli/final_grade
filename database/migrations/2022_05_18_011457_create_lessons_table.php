<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('pack_module_subject_id');
            $table->unsignedBigInteger('user_id');
            $table->string('content',512);
            $table->timestamp('reference');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('pack_module_subject_id')->references('id')->on('pack_module_subjects');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function(Blueprint $table) {
            $table->dropIndex('lessons_class_id_foreign');
            $table->dropIndex('lessons_pack_module_subject_id_foreign');
            $table->dropIndex('lessons_user_id_foreign');
        });

        Schema::dropIfExists('lessons');
    }
}
