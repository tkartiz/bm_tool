<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_spec_id');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->boolean('outsourcing')->nullable();
            $table->unsignedBigInteger('os_appd_id')->nullable();
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->integer('price_incl')->nullable();
            $table->integer('price_exc')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('works');
    }
}
