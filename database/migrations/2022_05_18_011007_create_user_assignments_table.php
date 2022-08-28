<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('pack_module_subject_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('user_assignments', function(Blueprint $table) {
            $table->dropIndex('user_assignments_user_id_foreign');
            $table->dropIndex('user_assignments_class_id_foreign');
            $table->dropIndex('user_assignments_pack_module_subject_id_foreign');
        });

        Schema::dropIfExists('user_assignments');
    }
}
