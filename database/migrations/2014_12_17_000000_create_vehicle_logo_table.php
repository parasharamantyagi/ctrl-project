<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleLogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_logos', function (Blueprint $table) {
            $table->string('vehicle_id');
			$table->string('brand')->nullable();
			$table->string('pad2_image')->nullable();
			$table->string('logo_image')->nullable();
			$table->string('icone_image')->nullable();
			$table->string('pad3_image')->nullable();
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
        Schema::dropIfExists('vehicle_logos');
    }
}
