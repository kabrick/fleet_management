<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fleet Management</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ public_path('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-size: 0.8em;
        }

        /*thead, tfoot { display: table-row-group }*/
        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-row-group;
        }

        tr {
            page-break-before: always;
            page-break-after: always;
            page-break-inside: avoid;
        }
    </style>

</head>

<body>

<h3 class="text-center">Vehicle Services</h3>

<table class="table table-bordered">
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

<hr>

<table class="table table-bordered">
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

    <tr><td colspan="10"></td></tr>

    <tr>
        <td><b>Totals</b></td>
        <td></td>
        <td></td>
        <td>{{ $overall_costs }}</td>
        <td></td>
    </tr>
    </tbody>
</table>
</body>

</html>
