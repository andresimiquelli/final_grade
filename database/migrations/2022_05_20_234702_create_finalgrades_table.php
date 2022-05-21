<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalgrades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedTinyInteger('value')->default(0);
            $table->unsignedSmallInteger('absences')->default(0);
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::table('finalgrades', function(Blueprint $table) {
            $table->dropIndex('finalgrades_subject_id_foreign');
            $table->dropIndex('finalgrades_enrollment_id_foreign');
        });

        Schema::dropIfExists('finalgrades');
    }
}
