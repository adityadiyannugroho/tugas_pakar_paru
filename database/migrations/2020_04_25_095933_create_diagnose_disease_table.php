<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnoseDiseaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnose_disease', function (Blueprint $table) {
            $table->unsignedBigInteger('diagnose_id');
            $table->unsignedBigInteger('disease_id');
            $table->decimal('score', 3, 2);

            $table->foreign('diagnose_id')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnose_diseases');
    }
}
