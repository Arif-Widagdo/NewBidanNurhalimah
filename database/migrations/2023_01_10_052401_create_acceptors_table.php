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
        Schema::create('acceptors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->index()->references('id')->on('patients')->onDelete('cascade');
            $table->foreignUuid('birthControl_id')->nullable();
            $table->date('menstrual_date')->nullable();
            $table->integer('weight');
            $table->string('blood_pressure');
            $table->string('complication')->nullable();
            $table->string('failure')->nullable();
            $table->text('description')->nullable();
            $table->date('return_date')->nullable();
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
        Schema::dropIfExists('acceptors');
    }
};
