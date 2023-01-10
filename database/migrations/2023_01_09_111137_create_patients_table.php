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
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_rm')->unique();
            $table->foreignUuid('user_id')->nullable();
            $table->foreignUuid('graduated_id')->nullable();
            $table->foreignUuid('work_id')->nullable();
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('place_brithday');
            $table->date('date_brithday');
            $table->enum('gender', ['F', 'M'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'dead_divorced'])->default('married');
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
        Schema::dropIfExists('patients');
    }
};
