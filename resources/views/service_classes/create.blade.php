@extends('layouts.main')

@section('content')
    <div class="white-box">
        <h4 class="text-center">Register Service Class</h4>

        <hr>

        @include('flash::message')

        {{ Form::open(['route' => 'service_classes.store', 'data-toggle' => 'validator']) }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', ['class' => 'form-control compulsory', 'required']) }}
                </div>
            </div>

            <div class="col-md-6"></div>
        </div>

        <br><br>

        {{ Form::button('Submit',['type'=>'submit','class'=>'btn btn-success waves-effect waves-light m-r-10']) }}
        {{ Form::button('Cancel',['type'=>'reset','class'=>'btn btn-primary waves-effect waves-light']) }}

        {{ Form::close() }}
    </div>
@endsection
