@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url'=>aurl('medicines')]) !!}
            <div class="form-group">
                {!! Form::label('name',trans('admin.name')) !!}
                {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description',trans('admin.description')) !!}
                {!! Form::text('description',old('description') ,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('type',trans('admin.type')) !!}
                {!! Form::select('type',['injection'=>trans('admin.injection'),
                 'capsules'=>trans('admin.capsules'),'drink'=>trans('admin.drink')],old('type'),['class'=>'form-control','placeholder'=>'...']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon',trans('admin.icon')) !!}
                {!! Form::file('icon',['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('quantity',trans('admin.quantity')) !!}
                {!! Form::number('quantity',old('quantity'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price',trans('admin.price')) !!}
                {!! Form::text('price',old('price'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('expired',trans('admin.expired')) !!}
                {!! Form::date('expired',old('expired'),['class'=>'form-control']) !!}
            </div>

            {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->





@endsection