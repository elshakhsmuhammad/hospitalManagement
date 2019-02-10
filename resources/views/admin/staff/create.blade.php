@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('staff'),'files'=>true]) !!}
     <div class="form-group">
        {!! Form::label('name',trans('admin.name')) !!}
        {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
     </div>
    
     <div class="form-group">
        {!! Form::label('password',trans('admin.password')) !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('phone',trans('admin.phone')) !!}
        {!! Form::text('phone',old('phone'),['class'=>'form-control']) !!}
     </div>
      <div class="form-group">
          {!! Form::label('icon',trans('admin.icon')) !!}
          {!! Form::file('icon',['class'=>'form-control']) !!}
      </div>
     <div class="form-group">
        {!! Form::label('job',trans('admin.job')) !!}
        {!! Form::select('job',['nursing'=>trans('admin.nursing'),
        'management'=>trans('admin.management'), 'worker'=>trans('admin.worker')],old('job'),['class'=>'form-control','placeholder'=>'.............']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('gender',trans('admin.gender')) !!}
           {!! Form::select('gender',['male'=>trans('admin.male'),
            'female'=>trans('admin.female')],old('gender'),['class'=>'form-control','placeholder'=>'...']) !!}
     </div>
      <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
     </div>
     {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection