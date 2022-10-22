@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Service Classes</h4>

        <br>

        @include('flash::message')

        <div class="table-responsive">
            <table class="table table-striped color-bordered-table success-bordered-table">
                <thead>
                <tr>
                    <th>Class Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td><a class="btn btn-primary" href="/service_classes/edit/{{ $class->id }}">Edit</a></td>
                        <td><a class="btn btn-danger" href="/service_classes/delete/{{ $class->id }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <a class="btn btn-success" href="/service_classes/create/">Add Service Class</a>
    </div>
@endsection
