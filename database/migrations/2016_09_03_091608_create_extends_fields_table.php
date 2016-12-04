<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtendsFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('parameters_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('items_id');
            $table->integer('parameters_id');
            $table->string('value');
            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::drop('parameters_values');
    }
}
