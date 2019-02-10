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
                {!! Form::open(['url'=>url('doctor/task/'.$prescription->id),'method'=>'put' ]) !!}
                <div class="form-group">
                    <input type = "hidden" name = "id" value = "{{doctor()->user()->id}}">
                    {!! Form::label('description',trans('admin.description')) !!}
                    {!! Form::textarea('description',$prescription->description,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('medicine',trans('admin.medicine')) !!}
                    {!! Form::select('medicine_id',App\medicine::pluck('name','id')
                    ,$prescription->medicine_id,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type',trans('admin.type')) !!}
                    {!! Form::select('type',['injection'=>trans('admin.injection'),
                     'capsules'=>trans('admin.capsules'),'drink'=>trans('admin.drink')],$prescription->type,['cla       ss'=>'form-control','placeholder'=>'...']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('quantity',trans('admin.quantity')) !!}
                    {!! Form::number('quantity',$prescription->quantity,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('patient',trans('admin.patient')) !!}
                    {!! Form::select('patient_id',App\Patient::pluck('name','id')
                    ,$prescription->patient_id ,['class'=>'form-control']) !!}
                </div>


                <div class="modal-footer">

                    {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            <!-- /.box-body -->
        </div>
    </div>   <!-- /.box -->
@endsection