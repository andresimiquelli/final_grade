<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('pack_module_subject_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

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
        Schema::table('journals', function(Blueprint $table) {
            $table->dropIndex('journals_class_id_foreign');
            $table->dropIndex('journals_pack_module_subject_id_foreign');
        });

        Schema::dropIfExists('journals');
    }
}
