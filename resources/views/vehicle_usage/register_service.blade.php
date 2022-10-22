@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Register Vehicle Servicing</h4>

        <hr>

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

        <hr>

        @include('flash::message')

        {{ Form::open(['route' => 'save_service', 'data-toggle' => 'validator']) }}

        {{ Form::hidden('vehicle_id', $vehicle->id) }}

        <div class="form-group">
            {{ Form::label('service_class', 'Service Class') }}
            {{ Form::select('service_class', $classes, '', ['class' => 'form-control', 'required']) }}
        </div>

        <br><br>

        <div class="form-group">
            {{ Form::label('service', 'Services') }}

            <a href="#service_div" onclick="add_misc()" class='btn btn-sm btn-success'>Add service</a>

            <div id='service_div'>
                <div class='row'>
                    <div class='col-md-6'>
                        <input type='text' name='service_names[]' class='form-control' placeholder='Name' required>
                    </div>
                    <div class='col-md-4'>
                        <input type='number' name='service_costs[]' class='form-control' placeholder='Cost' required>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        {{ Form::button('Submit',['type'=>'submit','class'=>'btn btn-success waves-effect waves-light m-r-10']) }}
        {{ Form::button('Cancel',['type'=>'reset','class'=>'btn btn-primary waves-effect waves-light']) }}

        {{ Form::close() }}
    </div>
@endsection

@push('scripts')
    <script>
        let max_rows = 20;
        let wrapper = $("#service_div");
        let x = 1;

        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });

        function add_misc() {
            if (x < max_rows) {
                $(wrapper).append("<br><div class='row'>\
                    <div class='col-md-6'><input type='text' name='service_names[]' class='form-control' placeholder='Name' required></div>\
                    <div class='col-md-4'><input type='number' name='service_costs[]' class='form-control' placeholder='Cost' required></div>\
                    <div class='col-md-2'><a class='remove_field btn btn-sm btn-rounded btn-danger' style='color: white;'>Remove</a></div>\
                    </div>");

                x++;
            }
        }
    </script>
@endpush
