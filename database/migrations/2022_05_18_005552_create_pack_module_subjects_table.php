<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackModuleSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_module_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pack_module_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedSmallInteger('load')->default(0);
            $table->unsignedMediumInteger('order')->default(0);
            $table->timestamps();

            $table->foreign('pack_module_id')->references('id')->on('pack_modules');
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
        Schema::table('pack_module_subjects', function(Blueprint $table) {
            $table->dropIndex('pack_module_subjects_pack_module_id_foreign');
            $table->dropIndex('pack_module_subjects_subject_id_foreign');
        });

        Schema::dropIfExists('pack_module_subjects');
    }
}
