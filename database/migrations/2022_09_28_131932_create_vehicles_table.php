<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->text('reg_no');
            $table->text('model');
            $table->text('engine');
            $table->text('chassis');
            $table->text('vehicle_type');
            $table->text('current_mileage')->nullable();
            $table->text('current_mileage_date')->nullable();
            $table->text('year_of_supply');
            $table->text('allocation');
            $table->text('station');
            $table->text('fuel_consumption')->comment('km per litre')->nullable();
            $table->text('running_cost')->comment('per km in GBP')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vehicles');
    }
};
