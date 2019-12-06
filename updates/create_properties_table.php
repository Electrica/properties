<?php namespace Electrica\Properties\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('electrica_properties_properties', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->index();
            $table->string('dimentions')->nullable();
            $table->string('temp_condition')->nullable();
            $table->string('volume')->nullable();
            $table->string('power')->nullable();
            $table->string('supply')->nullable();
            $table->string('production')->nullable();
            $table->string('perfomance')->nullable();
            $table->string('capacity')->nullable();
            $table->string('gas_power')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('electrica_properties_properties');
    }
}
