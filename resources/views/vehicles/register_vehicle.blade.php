@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Register Vehicle</h4>

        <hr>

        @include('flash::message')

        {{ Form::open(['route' => 'save_vehicle', 'data-toggle' => 'validator']) }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('reg_no', 'Registration Number') }}
                    {{ Form::text('reg_no', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('engine', 'Engine') }}
                    {{ Form::text('engine', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('chassis', 'Chassis') }}
                    {{ Form::text('chassis', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('vehicle_type', 'Vehicle Type') }}
                    {{ Form::text('vehicle_type', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('current_mileage', 'Current Mileage') }}
                    {{ Form::text('current_mileage', '', ['class' => 'form-control']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('current_mileage_date', 'Current Mileage Date') }}
                    {{ Form::text('current_mileage_date', '', ['class' => 'form-control', 'id' => 'current_mileage_date']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('model', 'Model') }}
                    {{ Form::text('model', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('year_of_supply', 'Year of Supply') }}
                    {{ Form::text('year_of_supply', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('allocation', 'Allocation') }}
                    {{ Form::text('allocation', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('station', 'Station') }}
                    {{ Form::text('station', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('fuel_consumption', 'Fuel Consumption (km per litre)') }}
                    {{ Form::text('fuel_consumption', '', ['class' => 'form-control']) }}
                </div>

                <br><br>

                <div class="form-group">
                    {{ Form::label('running_cost', 'Running Cost x km') }}
                    {{ Form::text('running_cost', '', ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <br><br>

        {{ Form::button('Submit',['type'=>'submit','class'=>'btn btn-success waves-effect waves-light m-r-10']) }}
        {{ Form::button('Cancel',['type'=>'reset','class'=>'btn btn-primary waves-effect waves-light']) }}

        {{ Form::close() }}
    </div>
@endsection
