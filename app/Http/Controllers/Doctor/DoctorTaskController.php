<?php

namespace App\Http\Controllers\Doctor;
use App\Doctor;
use  App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ExaminationsDatatable;
use App\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Patient;
use App\Examination;
use Illuminate\Support\Facades\DB;

class DoctorTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $doctor = doctor::find(doctor()->user()->id);
       $examinations =doctor::find(doctor()->user()->id)->examinations;
        $prescriptions =doctor::find(doctor()->user()->id)->prescriptions;
        return view ('doctors.description', ['title' => trans('admin.prescriptions')
           ,'examinations'=>$examinations,'prescriptions'=>$prescriptions,'doctor'=>$doctor]);


}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.description');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
            [

                'description' => 'sometimes|nullable|min:6',
                'type'    => 'required|in:injection,capsules,drink',
                'patient_id'   => 'required|numeric',
                'medicine_id'   => 'required|numeric',
                'quantity'    => 'required',



            ]);
        $prescription=new Prescription();
        $prescription->doctor_id=doctor()->user()->id;
        $prescription->description=$request->description;
        $prescription->type=$request->type;
        $prescription->patient_id=$request->patient_id;
        $prescription->medicine_id=$request->medicine_id;
        $prescription->quantity=$request->quantity;
//
        $prescription->save();


        return redirect(url('doctor/task'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescription = Prescription::find($id);
        $title   = trans('admin.edit');
        return view("doctors.editPrescription", compact('prescription', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [

                'description' => 'sometimes|nullable|min:6',
                'type'    => 'required|in:injection,capsules,drink',
                'patient_id'   => 'required|numeric',
                'medicine_id'   => 'required|numeric',
                'quantity'    => 'required',



            ]);
        $prescription=Prescription::find($id);
        $prescription->doctor_id=doctor()->user()->id;
        $prescription->description=$request->description;
        $prescription->type=$request->type;
        $prescription->patient_id=$request->patient_id;
        $prescription->medicine_id=$request->medicine_id;
        $prescription->quantity=$request->quantity;
//
        $prescription->save();


        return redirect(url('doctor/task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription=Prescription::find($id);
        $prescription->delete($id);
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('doctor/task'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $prescription = Examination::find($id);
                $prescription->delete();
            }
        } else {
            $prescription = Examination::find(request('item'));
            $prescription->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
      ///advanced  in project return redirect(aurl('examinations'));
    }
}


