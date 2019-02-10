@extends('admin.index')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('patients/'.$patient->id),'method'=>'put','files'=>true ]) !!}
     <div class="form-group">
        {!! Form::label('name',trans('admin.name')) !!}
        {!! Form::text('name',$patient->name,['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('password',trans('admin.password')) !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
     </div>
      <div class="form-group">
          {!! Form::label('image',trans('admin.image')) !!}
          {!! Form::file('image',['class'=>'form-control']) !!}

          @if(!empty($patient->image))
              <img src="{{ Storage::url($patient->image) }}" style="width:50px;height: 50px;" />
          @endif

      </div>
 <div class="form-group">
        {!! Form::label('phone',trans('admin.phone')) !!}
        {!! Form::text('phone',$patient->phone,['class'=>'form-control']) !!}
     </div>

      <div class="form-group">
        {!! Form::label('description',trans('admin.description')) !!}
        {!! Form::text('description',$patient->description,['class'=>'form-control']) !!}
     </div>

 <div class="form-group">
        {!! Form::label('gender',trans('admin.gender')) !!}
           {!! Form::select('gender',['male'=>trans('admin.male'),
            'female'=>trans('admin.female')],old('gender'),['class'=>'form-control','placeholder'=>'...']) !!}
     </div>
 <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',$patient->email,['class'=>'form-control']) !!}
     </div>
      <div class="form-group">
          {!! Form::label('department_id',trans('admin.department_id')) !!}
          {!! Form::select('department_id',App\Model\Department::pluck('name','id'),old('department_id'),['class'=>'form-control']) !!}
      </div>

    {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection