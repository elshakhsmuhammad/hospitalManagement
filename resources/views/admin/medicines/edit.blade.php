@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url'=>aurl('medicines/'.$medicine->id),'method'=>'put' ]) !!}
            <div class="form-group">
                {!! Form::label('name',trans('admin.name')) !!}
                {!! Form::text('name',$medicine->name,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description',trans('admin.description')) !!}
                {!! Form::text('description',$medicine->description ,['class'=>'form-control']) !!}
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
                {!! Form::number('quantity',$medicine->quantity,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price',trans('admin.price')) !!}
                {!! Form::text('price',$medicine->price,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('expired',trans('admin.expired')) !!}
                {!! Form::date('expired',$medicine->expired,['class'=>'form-control']) !!}
            </div>
            {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection