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
        Schema::create('assistidos', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('pessoa_id')->nullable(false);
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->string('local_arquivo', 32)->nullable(true);


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
        Schema::dropIfExists('assistidos');
    }
};
