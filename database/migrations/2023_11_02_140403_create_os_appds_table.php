<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsAppdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_appds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id');
            $table->string('comment')->nullable();
            $table->string('spec')->nullable();
            $table->string('order_recipient')->nullable();
            $table->integer('price_incl')->nullable();
            $table->integer('price_exc')->nullable();
            $table->string('price_list')->nullable();
            $table->integer('comp_num')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('appd1_id')->nullable();
            $table->boolean('appd1_approval')->nullable();
            $table->string('appd1_comment')->nullable();
            $table->date('appd1_appd_at')->nullable();
            $table->integer('appd2_id')->nullable();
            $table->boolean('appd2_approval')->nullable();
            $table->string('appd2_comment')->nullable();
            $table->date('appd2_appd_at')->nullable();
            $table->date('requested_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('os_appds');
    }
}
