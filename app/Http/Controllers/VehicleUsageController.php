<?php

namespace App\Http\Controllers;

use App\Models\ServiceClass;
use App\Models\Vehicle;
use App\Models\VehicleService;
use App\Models\VehicleUsage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleUsageController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function register_usage($vehicle_id) {
        $vehicle =  Vehicle::find($vehicle_id);

        // get last usage
        $last_usage = 0;
        $usage = VehicleUsage::where('vehicle_id', $vehicle_id)->orderBy('created_at', 'desc')->first();

        if ($usage) {
            $last_usage = $usage->mileage_end;
        }

        return view('vehicle_usage.register_usage', compact('vehicle', 'last_usage'));
    }

    public function save_usage(Request $request) {
        $usage = new VehicleUsage();

        $usage->vehicle_id = $request->vehicle_id;
        $usage->mileage_start = $request->mileage_start;
        $usage->days_in_workshop = $request->days_in_workshop;
        $usage->fuel_cost = $request->fuel_cost;
        $usage->driver = $request->driver;
        $usage->misc_names = $request->misc_names ? implode(',', $request->misc_names) : '';
        $usage->misc_costs = $request->misc_costs ? implode(',', $request->misc_costs) : '';
        $usage->mileage_end = $request->mileage_end;
        $usage->service_cost = $request->service_cost;
        $usage->tyre_cost = $request->tyre_cost;
        $usage->repair_names = $request->repair_names ? implode(',', $request->repair_names) : '';
        $usage->repair_costs = $request->repair_costs ? implode(',', $request->repair_costs) : '';
        $usage->comment = $request->comment;
        $usage->updated_by = Auth::id();
        $usage->created_by = Auth::id();

        try {
            $usage->save();

            flash("Vehicle usage has been registered")->success();
            return redirect('/vehicle_details/' . $request->vehicle_id);
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
            return back()->withInput();
        }
    }

    public function register_service($vehicle_id) {
        $vehicle =  Vehicle::find($vehicle_id);
        $classes = ServiceClass::pluck('name', 'id')->toArray();
        $classes = ['' => '--select--'] + $classes;

        return view('vehicle_usage.register_service', compact('vehicle', 'classes'));
    }

    public function save_service(Request $request) {
        $service = new VehicleService();

        $service->vehicle_id = $request->vehicle_id;
        $service->service_class = $request->service_class;
        $service->service_names = $request->service_names ? implode(',', $request->service_names) : '';
        $service->service_costs = $request->service_costs ? implode(',', $request->service_costs) : '';
        $service->updated_by = Auth::id();
        $service->created_by = Auth::id();

        try {
            $service->save();

            flash("Vehicle service has been registered")->success();
            return redirect('/vehicle_details/' . $request->vehicle_id);
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
            return back()->withInput();
        }
    }
}
