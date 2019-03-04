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
        dal -->
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
                        <input type = "hidden" name = "description" value = "{{patient()->user()->description}}">
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
           
            <table width="100%" class="table table-striped table-bordered table-hover" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('admin.description')}}</th>
                    <th>{{trans('admin.doctor_id')}}</th>
                    <th>{{trans('admin.medicine_id')}}</th>
                     <th>{{trans('admin.type')}}</th>
                      <th>{{trans('admin.quantity')}}</th>
                    <th>{{trans('admin.created_at')}}</th>




                </tr>
                </thead>
                <tbody>
                <?php $i=1 ?>
                @foreach($prescriptions as $prescription)
                    <tr>
                       
                        <th> {{$i++}}</th>

                        <td>{{$prescription->description}} </td>
                        <td>{{$prescription->doctor_id}} </td>
                         <td>{{$prescription->medicine_id}} </td>
                         <td>{{$prescription->type}} </td>
                         <td>{{$prescription->quantity}} </td>


                        <td> {{$prescription->created_at}}</td>

                        <td>
                     
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    

@endsection