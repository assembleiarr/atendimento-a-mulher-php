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

            $table->timestamp('data_hora')->nullable(true);
            $table->enum('recepcao_tipo', ['PRESENCIAL', 'ZAPCHAME'])->nullable(false);
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
