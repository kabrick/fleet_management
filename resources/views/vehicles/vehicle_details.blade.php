@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Vehicle Details</h4>

        <hr>

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
    </div>
@endsection
