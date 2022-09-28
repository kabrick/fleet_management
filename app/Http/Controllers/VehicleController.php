<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller {

    public function register_vehicle() {
        return view('vehicles.register_vehicle');
    }

    public function save_vehicle(Request $request) {
        request()->validate([
            'reg_no' => 'required',
            'engine' => 'required',
            'chassis' => 'required',
            'vehicle_type' => 'required',
            'model' => 'required',
            'year_of_supply' => 'required',
            'allocation' => 'required',
            'station' => 'required'
        ]);

        $vehicle = new Vehicle();

        $vehicle->reg_no = $request->reg_no;
        $vehicle->engine = $request->engine;
        $vehicle->chassis = $request->chassis;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->current_mileage = $request->current_mileage;
        $vehicle->current_mileage_date = $request->current_mileage_date;
        $vehicle->model = $request->model;
        $vehicle->year_of_supply = $request->year_of_supply;
        $vehicle->allocation = $request->allocation;
        $vehicle->station = $request->station;
        $vehicle->fuel_consumption = $request->fuel_consumption;
        $vehicle->running_cost = $request->running_cost;
        $vehicle->created_by = Auth::id();

        try {
            $vehicle->save();

            flash("Vehicle has been registered")->success();
            return redirect('home');
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
            return back()->withInput();
        }
    }

    public function edit_vehicle($id) {
        $vehicle =  Vehicle::find($id);

        return view('vehicles.edit_vehicle', compact('vehicle'));
    }

    public function save_vehicle_edits(Request $request) {
        $vehicle =  Vehicle::find($request->id);

        $vehicle->reg_no = $request->reg_no;
        $vehicle->engine = $request->engine;
        $vehicle->chassis = $request->chassis;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->current_mileage = $request->current_mileage;
        $vehicle->current_mileage_date = $request->current_mileage_date;
        $vehicle->model = $request->model;
        $vehicle->year_of_supply = $request->year_of_supply;
        $vehicle->allocation = $request->allocation;
        $vehicle->station = $request->station;
        $vehicle->fuel_consumption = $request->fuel_consumption;
        $vehicle->running_cost = $request->running_cost;
        $vehicle->updated_by = Auth::id();

        try {
            $vehicle->save();

            flash("Vehicle has been updated")->success();
            return redirect('home');
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
            return back()->withInput();
        }
    }

    public function delete_vehicle($id) {
        $vehicle =  Vehicle::find($id);

        try {
            $vehicle->delete();

            flash("Vehicle has been removed")->success();
            return redirect('home');
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
            return back()->withInput();
        }
    }

    public function vehicle_details($id) {
        $vehicle =  Vehicle::find($id);

        return view('vehicles.vehicle_details', compact('vehicle'));
    }
}
