@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Registered Vehicles</h4>

        <hr>

        @include('flash::message')

        <div class="table-responsive">
            <table class="table table-striped color-bordered-table success-bordered-table">
                <thead>
                    <tr>
                        <th>Reg No.</th>
                        <th>Model</th>
                        <th>Vehicle Type</th>
                        <th>Allocation</th>
                        <th>Station</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if(count($vehicles) > 0)
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->reg_no }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->vehicle_type }}</td>
                            <td>{{ $vehicle->allocation }}</td>
                            <td>{{ $vehicle->station }}</td>
                            <td>
                                <a class="btn btn-primary" href="vehicle_details/{{ $vehicle->id }}">Details</a>
                                <a class="btn btn-warning" href="edit_vehicle/{{ $vehicle->id }}">Edit</a>
                                <a class="btn btn-danger" href="delete_vehicle/{{ $vehicle->id }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center"><h4><code>No vehicles registered</code></h4></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
