<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void       
     */
    public function up()
    {
        Schema::create('vehicle_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicle_id');
            $table->string('background_color');
            $table->string('pad_line_color');
            $table->string('pad_background_color');
            $table->string('button_style');
            $table->string('daylight_auto_on');
            $table->string('reverse_speed_motor');
            $table->string('reverse_steer_motor');
            $table->string('motor_off');
            $table->string('steering_control_point');
            $table->string('asset_folder');
            $table->string('firmware');
            $table->string('front_motor');
            $table->string('rear_motor');
            $table->string('gearbox_amount_of_gears');
            $table->string('max_speed_per_gears');
            $table->string('speed_curve');
            $table->string('max_rpm');
            $table->string('idle_rpm');
            $table->string('upper_gear_shift_value');
            $table->string('lower_gear_shift_value');
            $table->string('cell_value_steer_pad');
            $table->string('gear_retio');
            $table->string('max_steering_angle');
            $table->string('led_configuration');
            $table->string('button_config_for_each_menu');
            $table->string('setting_status');
            $table->string('setting_use_status');
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
        Schema::dropIfExists('vehicle_settings');
    }
}
