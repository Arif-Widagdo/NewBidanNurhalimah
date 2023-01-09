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
        Schema::create('couples', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->nullable();
            $table->foreignUuid('graduated_id')->nullable();
            $table->foreignUuid('work_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('place_brithday')->nullable();
            $table->date('date_brithday')->nullable();
            $table->enum('gender', ['F', 'M'])->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('couples');
    }
};
