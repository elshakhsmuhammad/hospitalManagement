@extends('doctors.index')
@section('content')
    <div class="list-group">
        <div class="box-body">
        <a href="#" class="list-group-item dark">
            <div class="card "><div class="col-lg-9">
            <span class="list-group-item-heading">{{trans('admin.doctor')}}: {{doctor()->user()->name}}</span>
            <h4>{{trans('admin.name')}}: {{doctor()->user()->name}}</h4>
            <h4>{{trans('admin.specialized')}}: {{doctor()->user()->specialized}}</h4>
            <h4>{{trans('admin.email')}}:{{doctor()->user()->email}}</h4>
            <h5>{{trans('admin.phone')}}:{{doctor()->user()->phone}}</h5>
                </div>


            <p class="list-group-item-text"><img src="{{ Storage::url($doctor->image) }}"
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
    <a type="button" class="btn btn-primary btn-lg" href="{{url("doctor/info/")}}">
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
                       {!! Form::open(['url'=>url('doctor/doctor')]) !!}
                       <div class="form-group">
                           <input type = "hidden" name = "id" value = "{{doctor()->user()->id}}">
                           {!! Form::label('description',trans('admin.description')) !!}
                           {!! Form::textarea('description',old('description'),['class'=>'form-control']) !!}
                       </div>


                       <div class="form-group">
                           {!! Form::label('patient',trans('admin.patient')) !!}
                           {!! Form::select('patient_id',App\Patient::pluck('name','id')
                           ,old('patient_id'),['class'=>'form-control']) !!}
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
                    {!! Form::open(['url'=>url("doctor/photo/$doctor->id/upload"),'method'=>'post' ]) !!}

                    <input type = "hidden" name = "name" value = "{{doctor()->user()->name}}">
                    <input type = "hidden" name = "email" value = "{{doctor()->user()->email}}">
                    <input type = "hidden" name = "phone" value = "{{doctor()->user()->phone}}">
                    <input type = "hidden" name = "specialized" value = "{{doctor()->user()->specialized}}">
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
               <th>{{trans('admin.patient_id')}}</th>
               <th>{{trans('admin.created_at')}}</th>
               <th>{{trans('admin.edit')}}</th>
               <th>{{trans('admin.delete')}}</th>



           </tr>
           </thead>
           <tbody>
           <?php $i=1 ?>
           @foreach($examinations as $examination)
               <tr>
                   <th> {{$i++}}</th>

                   <td>{{$examination->description}} </td>
                   <td>{{$examination->patient_id}} </td>


                   <td> {{$examination->created_at}}</td>

                   <td>
                       <div class="row">
                           <div class="col-md-2">
                               <a href="{{url("doctor/doctor/$examination->id/edit")}}" class="btn btn-info">
                                   <i class="fa fa-pencil"></i></a></div>

                           </div></td>
                   <td>
                       <div class="col-md-2">
                           <form action="{{route('deleteEamination',$examination->id)}}" method="post">
                               <input type="hidden" name="_method" value="DELETE">
                               {{ csrf_field()}}
                               <button type="submit" class="btn btn-danger" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o"></i></button>
                           </form>
                       </div>
                   </td>

               </tr>
           @endforeach
           </tbody>
       </table>
   </div>

   </div>
@endsection