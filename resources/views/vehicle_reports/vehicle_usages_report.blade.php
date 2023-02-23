@extends('layouts.main')

@push('styles')
    <link href="{{ asset('bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="white-box">
        {{ Form::open(['route' => 'vehicle_usages_report', 'data-toggle' => 'validator']) }}

        <div class="row">
            <div class="col-md-2">
                {{ Form::label('start_date', 'Start Date') }}
                {{ Form::text('start_date', '', ['class' => 'form-control', 'id' => 'start_date', 'placeholder' => 'Start Date', 'required', 'readonly']) }}
            </div>
            <div class="col-md-2">
                {{ Form::label('end_date', 'End Date') }}
                {{ Form::text('end_date', '', ['class' => 'form-control', 'id' => 'end_date', 'placeholder' => 'End Date', 'required', 'readonly']) }}
            </div>
            <div class="col-md-2">
                {{ Form::button('Submit',['type'=>'submit','class'=>'btn btn-success waves-effect waves-light m-r-10']) }}
            </div>
        </div>

        {{ Form::close() }}

        <hr>

        <h4 class="text-center">Vehicle Usage Reports</h4>

        <br>

        @include('flash::message')

        <div class="table-responsive">
            <table class="table table-striped color-bordered-table success-bordered-table">
                <thead>
                <tr>
                    <th>Registration Number</th>
                    <th>Vehicle Type</th>
                    <th>Model</th>
                    <th>Station</th>
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
                        <td>{{ $usage->reg_no }}</td>
                        <td>{{ $usage->vehicle_type }}</td>
                        <td>{{ $usage->model }}</td>
                        <td>{{ $usage->station }}</td>
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

                <tr><td colspan="14"></td></tr>

                <tr>
                    <td><b>Totals</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $total_days_in_workshop }}</td>
                    <td>{{ monetary($total_fuel_cost) }}</td>
                    <td>{{ monetary($total_service_cost) }}</td>
                    <td>{{ monetary($total_tyre_cost) }}</td>
                    <td>{{ monetary($total_repairs) }}</td>
                    <td>{{ monetary($total_misc) }}</td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

        <a class="btn btn-success" target="_blank" href="">Export PDF</a>

        <a class="btn btn-success" target="_blank" href="">Export CSV</a>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $(document).ready(function() {
            //
        });
    </script>
@endpush
