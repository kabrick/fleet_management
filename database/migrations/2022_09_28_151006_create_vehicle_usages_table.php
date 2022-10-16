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
        Schema::create('vehicle_usages', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id');
            $table->integer('days_in_workshop');
            $table->integer('mileage_start');
            $table->integer('mileage_end');
            $table->integer('fuel_cost');
            $table->integer('service_cost');
            $table->text('repair_names');
            $table->text('repair_costs');
            $table->integer('tyre_cost');
            $table->text('misc_names');
            $table->text('misc_costs');
            $table->text('driver')->nullable();
            $table->text('comment')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('vehicle_usages');
    }
};
