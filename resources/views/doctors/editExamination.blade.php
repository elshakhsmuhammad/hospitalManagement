@extends('doctors.index')
@section('content')

    <h2>{{trans('admin.doctor_name')}}</h2>
    <div>
        <span>{{doctor()->user()->name}}</span></div><div>
        <img src="{{url('/images/slider-image1.jpg')}}" alt="..." class="img-circle" style="width:200px;height: 200px "></div>
    <div>


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{  '  '.trans('admin.add_examination')}} </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(['url'=>url('doctor/doctor/'.$examination->id),'method'=>'put','files'=>true ]) !!}
                <div class="form-group">
                    <input type = "hidden" name = "id" value = "{{doctor()->user()->id}}">
                    {!! Form::label('description',trans('admin.description')) !!}
                    {!! Form::textarea('description',$examination->description,['class'=>'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('patient',trans('admin.patient')) !!}
                    {!! Form::select('patient_id',App\Patient::pluck('name','id')
                    ,old('patient_id'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
    </div>   <!-- /.box -->
@endsection