@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url'=>aurl('reckonings')]) !!}
            <div class="form-group">
                {!! Form::label('patient_id',trans('admin.patient_id')) !!}
                {!! Form::select('patient_id',App\Patient::pluck('name','id'),old('patient_id'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('medicine_id',trans('admin.medicine_id')) !!}
                {!! Form::select('medicine_id',App\medicine::pluck('name','id'),old('medicine_id'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('quantity',trans('admin.quantity')) !!}
                {!! Form::number('quantity',old('quantity'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('day',trans('admin.day')) !!}
                {!! Form::number('day',old('day'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price',trans('admin.price')) !!}
                {!! Form::number('price',old('price'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Surgeries_price',trans('admin.Surgeries_price')) !!}
                {!! Form::number('Surgeries_price',old('Surgeries_price'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('other',trans('admin.other')) !!}
                {!! Form::number('other',old('other'),['class'=>'form-control']) !!}

            </div>
            {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection