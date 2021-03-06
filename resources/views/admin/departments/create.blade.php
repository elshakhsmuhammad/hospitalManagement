@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title . '  '.trans('admin.doctor')}} </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url'=>aurl('departments')]) !!}
            <div class="form-group">
                {!! Form::label('name',trans('admin.name')) !!}
                {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('capacity',trans('admin.capacity')) !!}
                {!! Form::number('capacity',old('capacity'),['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon',trans('admin.icon')) !!}
                {!! Form::file('icon',['class'=>'form-control']) !!}

                @if(!empty(setting()->icon))
                    <img src="{{ Storage::url(setting()->icon) }}" style="width:50px;height: 50px;" />
                @endif

            </div>

            </div>
            {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection