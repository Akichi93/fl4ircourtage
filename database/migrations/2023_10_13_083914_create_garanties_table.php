<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garanties', function (Blueprint $table) {
            $table->bigIncrements('id_garantie');
            $table->unsignedBigInteger('id_contrat');
            $table->foreign('id_contrat')
                ->references('id_contrat')
                ->on('contrats')
                ->onDelete('cascade');
            $table->string('nom_garantie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garanties');
    }
}
