<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void       
     */
    public function up()
    {
		
        Schema::create('user_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('vehicle_id');
            $table->string('setting_id');
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
            $table->integer('front_motor_resistor_value');
            $table->integer('rear_motor_resistor_value');
            $table->integer('front_motor_off_ms');
            $table->integer('gearbox_amount_of_gears');
            $table->integer('motor_trim_kit');
            $table->integer('max_rpm');
            $table->integer('idle_rpm');
            $table->integer('upper_gear_shift_value');
            $table->integer('lower_gear_shift_value');
            $table->integer('gear_shift_a_rpm_value');
            $table->double('max_steering_angle');
            $table->integer('gear_shift_a_value');
            $table->integer('gear_shift_b_value');
            $table->string('front_motor');
            $table->string('rear_motor');
            $table->string('max_speed_per_gears');
            $table->string('cell_value_steer_pad');
            $table->string('gear_retio');
            $table->string('led_configuration');
            $table->string('button_config_for_each_menu');
            $table->integer('setting_status')->default(1);
            $table->integer('setting_use_status')->default(1);
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
        Schema::dropIfExists('user_settings');
    }
}
