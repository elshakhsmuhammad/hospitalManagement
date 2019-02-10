@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('doctors/'.$doctor->id),'method'=>'put','files'=>true ]) !!}
     <div class="form-group">
        {!! Form::label('name',trans('admin.name')) !!}
        {!! Form::text('name',$doctor->name,['class'=>'form-control']) !!}
     </div>
    
     <div class="form-group">
        {!! Form::label('password',trans('admin.password')) !!}
        {!! Form::password('password',$doctor->password,['class'=>'form-control']) !!}
     </div>
      <div class="form-group">
          {!! Form::label('image',trans('admin.image')) !!}
          {!! Form::file('image',['class'=>'form-control']) !!}

          @if(!empty($doctor->image))
              <img src="{{ Storage::url($doctor->image) }}" style="width:50px;height: 50px;" />
          @endif

      </div>

    </div>
 <div class="form-group">
        {!! Form::label('phone',trans('admin.phone')) !!}
        {!! Form::text('phone',$doctor->phone,['class'=>'form-control']) !!}
     </div>
    
      <div class="form-group">
        {!! Form::label('specialized',trans('admin.specialized')) !!}
        {!! Form::text('specialized',$doctor->specialized,['class'=>'form-control']) !!}
     </div>
    
 <div class="form-group">
        {!! Form::label('gender',trans('admin.gender')) !!}
           {!! Form::select('gender',['male'=>trans('admin.male'),
            'female'=>trans('admin.female')],old('gender'),['class'=>'form-control','placeholder'=>'...']) !!}
     </div>
 <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',$doctor->email,['class'=>'form-control']) !!}
     </div>
     {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection