@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Vehicle Details</h4>

        <br>

        @include('flash::message')

        <div class="table-responsive">
            <table class="table table-striped color-bordered-table success-bordered-table">
                <tbody>
                <tr>
                    <th><b>Registration Number</b></th>
                    <td>{{ $vehicle->reg_no }}</td>
                    <th><b>Engine</b></th>
                    <td>{{ $vehicle->engine }}</td>
                    <th><b>Chassis</b></th>
                    <td>{{ $vehicle->chassis }}</td>
                    <th><b>Vehicle Type</b></th>
                    <td>{{ $vehicle->vehicle_type }}</td>
                </tr>
                <tr>
                    <th><b>Current Mileage</b></th>
                    <td>{{ $vehicle->current_mileage }}</td>
                    <th><b>Current Mileage Date</b></th>
                    <td>{{ $vehicle->current_mileage_date }}</td>
                    <th><b>Model</b></th>
                    <td>{{ $vehicle->model }}</td>
                    <th><b>Year of Supply</b></th>
                    <td>{{ $vehicle->year_of_supply }}</td>
                </tr>
                <tr>
                    <th><b>Allocation</b></th>
                    <td>{{ $vehicle->allocation }}</td>
                    <th><b>Station</b></th>
                    <td>{{ $vehicle->station }}</td>
                    <th><b>Fuel Consumption (km per litre)</b></th>
                    <td>{{ $vehicle->fuel_consumption }}</td>
                    <th><b>Running Cost x km</b></th>
                    <td>{{ $vehicle->running_cost }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <br><hr><br>

        <h4 class="text-center">Vehicle Usage</h4>

        <br>

        <div class="table-responsive">
            <table class="table table-striped color-bordered-table success-bordered-table">
                <thead>
                    <tr>
                        <th>Mileage Start</th>
                        <th>Mileage End</th>
                        <th>Days in Workshop</th>
                        <th>Fuel Cost</th>
                        <th>Service Cost</th>
                        <th>Tyre Cost</th>
                        <th>Repairs</th>
                        <th>Miscellaneous</th>
                        <th>Driver</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_days_in_workshop = 0;
                        $total_fuel_cost = 0;
                        $total_service_cost = 0;
                        $total_tyre_cost = 0;
                        $total_repairs = 0;
                        $total_misc = 0;
                    @endphp
                    @foreach($usages as $usage)
                        @php
                            $total_days_in_workshop += $usage->days_in_workshop;
                            $total_fuel_cost += $usage->fuel_cost;
                            $total_service_cost += $usage->service_cost;
                            $total_tyre_cost += $usage->tyre_cost;
                        @endphp
                        <tr>
                            <td>{{ $usage->mileage_start }}</td>
                            <td>{{ $usage->mileage_end }}</td>
                            <td>{{ $usage->days_in_workshop }}</td>
                            <td>{{ $usage->fuel_cost }}</td>
                            <td>{{ $usage->service_cost }}</td>
                            <td>{{ $usage->tyre_cost }}</td>
                            <td>
                                @if(!is_null($usage->repair_names))
                                    @php
                                        $repair_names = explode(",", $usage->repair_names);
                                        $repair_costs = explode(",", $usage->repair_costs);
                                    @endphp

                                    <ol>
                                        @for($i = 0; $i < count($repair_names); $i++)
                                            @php $total_repairs += +$repair_costs[$i]; @endphp
                                            <li>{{ $repair_names[$i] }} - ({{ $repair_costs[$i] }})</li>
                                        @endfor
                                    </ol>
                                @endif
                            </td>
                            <td>
                                @if(!is_null($usage->misc_names))
                                    @php
                                        $misc_names = explode(",", $usage->misc_names);
                                        $misc_costs = explode(",", $usage->misc_costs);
                                    @endphp

                                    <ol>
                                        @for($i = 0; $i < count($misc_names); $i++)
                                            @php $total_misc += +$misc_costs[$i]; @endphp
                                            <li>{{ $misc_names[$i] }} - ({{ $misc_costs[$i] }})</li>
                                        @endfor
                                    </ol>
                                @endif
                            </td>
                            <td>{{ $usage->driver }}</td>
                            <td>{{ $usage->created_at }} by {{ get_name($usage->created_by, 'id', 'name', 'users') }}</td>
                        </tr>
                    @endforeach

                    <tr><td colspan="10"></td></tr>

                    <tr>
                        <td><b>Totals</b></td>
                        <td></td>
                        <td>{{ $total_days_in_workshop }}</td>
                        <td>{{ $total_fuel_cost }}</td>
                        <td>{{ $total_service_cost }}</td>
                        <td>{{ $total_tyre_cost }}</td>
                        <td>{{ $total_repairs }}</td>
                        <td>{{ $total_misc }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <a class="btn btn-primary" href="/register_usage/{{ $vehicle->id }}">Register Usage</a>

        <a class="btn btn-success" target="_blank" href="/vehicle_usage_pdf/{{ $vehicle->id }}">Export PDF</a>

        <a class="btn btn-success" target="_blank" href="/register_service/{{ $vehicle->id }}">Export CSV</a>

        <br><hr><br>

        <h4 class="text-center">Vehicle Service</h4>

        <br>

        <div class="table-responsive">
            <table class="table table-striped color-bordered-table success-bordered-table">
                <thead>
                <tr>
                    <th>Service Class</th>
                    <th>Items</th>
                    <th>Costs</th>
                    <th>Total Cost</th>
                    <th>Registered</th>
                </tr>
                </thead>
                <tbody>
                @php $overall_costs = 0; @endphp
                @foreach($services as $service)
                    @php $total_costs = 0; @endphp
                    <tr>
                        <td>{{ $classes[$service->service_class] }}</td>
                        <td>
                            @php $service_names = explode(',', $service->service_names); @endphp
                            <ul>
                                @foreach($service_names as $service_name)
                                    <li>{{ $service_name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @php $service_costs = explode(',', $service->service_costs); @endphp
                            <ul>
                                @foreach($service_costs as $service_cost)
                                    @php $total_costs += $service_cost; $overall_costs += $service_cost; @endphp
                                    <li>{{ $service_cost }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $total_costs }}</td>
                        <td>{{ $service->created_at }} by {{ get_name($service->created_by, 'id', 'name', 'users') }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td><b>Totals</b></td>
                    <td></td>
                    <td></td>
                    <td>{{ $overall_costs }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

        <a class="btn btn-primary" href="/register_service/{{ $vehicle->id }}">Register Service</a>

        <a class="btn btn-success" target="_blank" href="/vehicle_service_pdf/{{ $vehicle->id }}">Export PDF</a>

        <a class="btn btn-success" target="_blank" href="/register_service/{{ $vehicle->id }}">Export CSV</a>
    </div>
@endsection
