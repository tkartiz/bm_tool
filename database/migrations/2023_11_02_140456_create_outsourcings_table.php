<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsourcingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outsourcings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('os_appd_id');
            $table->string('comp_name')->nullable();
            $table->integer('comp_price_incl')->nullable();
            $table->integer('comp_price_exc')->nullable();
            $table->string('remarks')->nullable();
            $table->string('comp_file1')->nullable();
            $table->string('comp_file2')->nullable();
            $table->string('comp_file3')->nullable();
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
        Schema::dropIfExists('outsourcings');
    }
}
