@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Register Vehicle Usage</h4>

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

        {{ Form::open(['route' => 'save_usage', 'data-toggle' => 'validator']) }}

        {{ Form::hidden('vehicle_id', $vehicle->id) }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('mileage_start', 'Mileage Start') }}
                    {{ Form::number('mileage_start', $last_usage, ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('days_in_workshop', 'Days in Workshop') }}
                    {{ Form::number('days_in_workshop', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('fuel_cost', 'Fuel Cost') }}
                    {{ Form::number('fuel_cost', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('driver', 'Driver') }}
                    {{ Form::text('driver', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('misc', 'Miscellaneous Costs') }}

                    <a href="#misc_div" onclick="add_misc()" class='btn btn-sm btn-success'>Add repair</a>

                    <div id='misc_div'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <input type='text' name='misc_names[]' class='form-control' placeholder='Name'>
                            </div>
                            <div class='col-md-6'>
                                <input type='number' name='misc_costs[]' class='form-control' placeholder='Cost'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('mileage_end', 'Mileage End') }}
                    {{ Form::number('mileage_end', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('service_cost', 'Service Cost') }}
                    {{ Form::number('service_cost', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('tyre_cost', 'Tyre Cost') }}
                    {{ Form::number('tyre_cost', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('repairs', 'Repairs') }}

                    <a href="#repairs_div" onclick="add_repair()" class='btn btn-sm btn-success'>Add repair</a>

                    <div id='repairs_div'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <input type='text' name='repair_names[]' class='form-control' placeholder='Name'>
                            </div>
                            <div class='col-md-6'>
                                <input type='number' name='repair_costs[]' class='form-control' placeholder='Cost'>
                            </div>
                        </div>
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
        let wrapper = $("#misc_div");
        let x = 1;
        let max_rows_repair = 20;
        let wrapper_repair = $("#repairs_div");
        let x_repair = 1;

        $(wrapper).on("click", ".remove_field_misc", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });

        function add_misc() {
            if (x < max_rows) {
                $(wrapper).append("<br><div class='row'>\
                    <div class='col-md-6'><input type='text' name='misc_names[]' class='form-control' placeholder='Name'></div>\
                    <div class='col-md-4'><input type='number' name='misc_costs[]' class='form-control' placeholder='Cost'></div>\
                    <div class='col-md-2'><a class='remove_field_misc btn btn-sm btn-rounded btn-danger' style='color: white;'>Remove</a></div>\
                    </div>");

                x++;
            }
        }

        $(wrapper_repair).on("click", ".remove_field_repair", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x_repair--;
        });

        function add_repair() {
            if (x_repair < max_rows_repair) {
                $(wrapper_repair).append("<br><div class='row'>\
                    <div class='col-md-6'><input type='text' name='repair_names[]' class='form-control' placeholder='Name'></div>\
                    <div class='col-md-4'><input type='number' name='repair_costs[]' class='form-control' placeholder='Cost'></div>\
                    <div class='col-md-2'><a class='remove_field_repair btn btn-sm btn-rounded btn-danger' style='color: white;'>Remove</a></div>\
                    </div>");

                x_repair++;
            }
        }
    </script>
@endpush
