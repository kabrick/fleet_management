<?php

namespace App\Http\Controllers;

use App\Models\VehicleUsage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleReportsController extends Controller {

    public function vehicle_usages_report(Request $request) {
        if (isset($request->start_date)){
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        } else {
            $start_date = Carbon::now()->startOfDay();
            $end_date = Carbon::now()->endOfDay();
        }

        $usages = VehicleUsage::join('vehicles', 'vehicles.id', '=', 'vehicle_usages.vehicle_id')
            ->whereBetween('vehicle_usages.created_at', [$start_date, $end_date])
            ->get(['vehicle_usages.*', 'vehicles.vehicle_type', 'vehicles.model', 'vehicles.reg_no', 'vehicles.station']);

        return view('vehicle_reports.vehicle_usages_report', compact('usages'));
    }

    public function vehicle_services_report(Request $request) {
        return view('vehicle_reports.vehicle_services_report');
    }
}
