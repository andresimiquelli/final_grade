<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pack_id');
            $table->string('name',191);
            $table->string('description',256)->nullable();
            $table->timestamps();

            $table->foreign('pack_id')->references('id')->on('packs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pack_modules', function(Blueprint $table) {
            $table->dropIndex('pack_modules_pack_id_foreign');
        });

        Schema::dropIfExists('pack_modules');
    }
}
