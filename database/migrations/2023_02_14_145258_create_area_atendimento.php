<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_atendimento', function (Blueprint $table) {
            $table->id();

            
            $table->unsignedInteger('area_id')->nullable(true);
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade');

            $table->unsignedInteger('atendimento_id')->nullable(true);
            $table->foreign('atendimento_id')->references('id')->on('atendimentos')->onUpdade('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_atendimento');
    }
};
