<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand');
            $table->string('model');
            $table->string('user_id');
            $table->string('model_spec');
            $table->string('release_year');
            $table->string('moter_type');
            $table->string('horse_power');
            $table->string('torque');
            $table->string('km_h_0_100');
            $table->string('km_h_0_160');
            $table->string('km_h_100_0');
            $table->string('weight');
            $table->string('max_weight');
            $table->string('manufacturer');
            $table->string('scale');
            $table->string('vehicle_type');
            $table->string('special_car_specialization');
            $table->string('lenght');
            $table->string('length_front_of_car');
            $table->string('wheelbase');
            $table->string('track_width');
            $table->string('width');
            $table->string('wheel_diameter');
            $table->string('height');
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
        Schema::dropIfExists('vehicles');
    }
}
