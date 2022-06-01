<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('active');
            $table->string('section1');
            $table->string('vendor_code')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('diameter')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('price');
            $table->string('img')->nullable();
            $table->string('url')->nullable();
            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops');
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
        Schema::dropIfExists('catalogs');
    }
}
