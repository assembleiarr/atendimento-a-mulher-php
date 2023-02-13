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
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('assistido_id')->nullable(true);
            $table->foreign('assistido_id')->references('id')->on('assistidos')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('area_id')->nullable(true);
            $table->foreign('area_id')->references('id')->on('areas');

            $table->timestamp('data_hora')->nullable(true);
            $table->string('recepcao_tipo',16)->nullable(false);
            $table->boolean('is_importado')->nullable(true);
            $table->string('areas')->nullable(true);
            $table->text('observacao')->nullable(true);
            
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
        Schema::dropIfExists('atendimentos');
    }
};
