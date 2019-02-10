@extends('patients.index')
@section('content')


    <div class="list-group">
        <div class="box-body">
            <a href="#" class="list-group-item dark">
                <div class="card "><div class="col-lg-9">
                        <span class="list-group-item-heading">{{trans('admin.patient')}}: {{patient()->user()->name}}</span>
                        <h4>{{trans('admin.name')}}: {{patient()->user()->name}}</h4>
                        <h4>{{trans('admin.description')}}: {{patient()->user()->description}}</h4>
                        <h4>{{trans('admin.email')}}:{{patient()->user()->email}}</h4>
                        <h5>{{trans('admin.phone')}}:{{patient()->user()->phone}}</h5>
                    </div>


                    <p class="list-group-item-text"><img src="{{ Storage::url($patient->image) }}"
                                                         alt="test" class="img-circle" style="width:200px;height: 200px "></p>
                </div>
            </a>
        </div>
    </div>
    <h2></h2>

    <div>
        <div class="row">
            <div class="col-lg-9">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    {{trans('admin.add_examination')}}
                </button>
            </div>
            <a type="button" class="btn btn-primary btn-lg" href="{{url("patient/info/")}}">
                {{trans('admin.edit')}}
            </a>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">

                            </h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['url'=>url('patient/patient')]) !!}
                            <div class="form-group">
                                <input type = "hidden" name = "id" value = "{{patient()->user()->id}}">
                                {!! Form::label('description',trans('admin.description')) !!}
                                {!! Form::textarea('description',old('description'),['class'=>'form-control']) !!}
                            </div>


                            <div class="form-group">
                                {!! Form::label('doctor',trans('admin.doctor')) !!}
                                {!! Form::select('doctor_id',App\Doctor::pluck('name','id')
                                ,old('doctor_id'),['class'=>'form-control']) !!}
                            </div>

                        </div>
                        <div class="modal-footer">

                            {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <!-- upload photos-->
        <!-- Modal -->
        <div class="modal fade" id="myModa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">

                        </h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url'=>url("patient/photo/$patient->id/upload"),'method'=>'post' ]) !!}

                        <input type = "hidden" name = "name" value = "{{patient()->user()->name}}">
                        <input type = "hidden" name = "email" value = "{{patient()->user()->email}}">
                        <input type = "hidden" name = "phone" value = "{{patient()->user()->phone}}">
                        <input type = "hidden" name = "specialized" value = "{{patient()->user()->specialized}}">
                        <div class="form-group">
                            {!! Form::label('image',trans('admin.icon')) !!}
                            {!! Form::file('image',['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <div class="x_content">
            <p>{{trans('admin.examination')}}</p>
            <table width="100%" class="table table-striped table-bordered table-hover" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('admin.description')}}</th>
                    <th>{{trans('admin.doctor_id')}}</th>
                    <th>{{trans('admin.created_at')}}</th>




                </tr>
                </thead>
                <tbody>
                <?php $i=1 ?>
                @foreach($examinations as $examination)
                    <tr>
                        <th> {{$i++}}</th>

                        <td>{{$examination->description}} </td>
                        <td>{{$examination->doctor_id}} </td>


                        <td> {{$examination->created_at}}</td>

                        <td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    

@endsection