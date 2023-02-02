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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 128)->nullable(true);
            $table->string('cpf', 11)->nullable(true);
            $table->enum('sexo', ['M', 'F', 'OUTROS'])->nullable(true);
            $table->string('local_arquivo', 32)->nullable(true);
            $table->date('data_nascimento')->nullable(true);
            $table->string('telefone_principal', 11)->nullable(true);
            $table->string('telefone_alternativo', 11)->nullable(true);
            $table->string('escolaridade', 11)->nullable(true);
            $table->string('naturalidade', 128)->nullable(true);
            $table->string('profissao', 32)->nullable(true);
            $table->boolean('is_deficiente')->nullable(true);
            $table->decimal('renda_familiar', 6, 2)->nullable(true);

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
        Schema::dropIfExists('pessoas');
    }
};