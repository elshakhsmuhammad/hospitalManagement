@extends('patients.index')
@section('content')

    <div class="list-group">
        <div class="box-body">
            <a href="#" class="list-group-item dark">
                <div class="card "><div class="col-lg-9">
                        <span class="list-group-item-heading">{{trans('admin.patient')}}: {{patient()->user()->name}}</span>
                        <h4>{{trans('admin.name')}}: {{patient()->user()->name}}</h4>
                        <h4>{{trans('admin.specialized')}}: {{patient()->user()->specialized}}</h4>
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


                </tbody>
            </table>
        </div>

    </div>
    </div>
@endsection