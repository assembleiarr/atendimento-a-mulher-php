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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('pessoa_id')->nullable(false);
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onUpdate('cascade')->onDelete('cascade');

            $table->string('cep', 8)->nullable(true);
            $table->string('logradouro', 128)->nullable(true);
            $table->string('numero', 16)->nullable(true);
            $table->string('bairro', 32)->nullable(true);

            $table->string('complemento', 128)->nullable(true);

            $table->unsignedInteger('municipio_id')->nullable(true);
            $table->foreign('municipio_id')->references('id')->on('municipios')->onUpdate('cascade')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
};
