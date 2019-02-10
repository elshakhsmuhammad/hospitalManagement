@extends('doctors.index')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>url('doctor/info/'.doctor()->user()->id),'method'=>'put','files'=>true ]) !!}
        <div class="form-group">
            {!! Form::label('name',trans('admin.name')) !!}
            {!! Form::text('name',doctor()->user()->name,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password',trans('admin.password')) !!}
            {!! Form::password('password',doctor()->user()->password,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('image',trans('admin.image')) !!}
            {!! Form::file('image',['class'=>'form-control']) !!}

            @if(!empty(doctor()->user()->image))
                <img src="{{ Storage::url(doctor()->user()->image) }}" style="width:50px;height: 50px;" />
            @endif

        </div>

    </div>
    <div class="form-group">
        {!! Form::label('phone',trans('admin.phone')) !!}
        {!! Form::text('phone',doctor()->user()->phone,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('specialized',trans('admin.specialized')) !!}
        {!! Form::text('specialized',doctor()->user()->specialized,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('gender',trans('admin.gender')) !!}
        {!! Form::select('gender',['male'=>trans('admin.male'),
         'female'=>trans('admin.female')],old('gender'),['class'=>'form-control','placeholder'=>'...']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',doctor()->user()->email,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->



@section('content')