<?php

namespace App\Http\Controllers\Patient;
//use App\Doctor;

use  App\Http\Controllers\Admin;
use  App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use App\DataTables\ExaminationsDatatable;
use App\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Patient;
use App\Examination;
use Illuminate\Support\Facades\DB;
class PatientTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $patient = patient::find(patient()->user()->id);
        $prescriptions =patient::find(patient()->user()->id)->prescriptions;
        $doctor = DB::table('doctors')
            ->join('examinations', 'doctors.id', '=', 'examinations.doctor_id')
            ->select('doctors.*', 'examinations.id', 'examinations.description')
            ->get();
        return view('patients.prescription', ['title' => trans('admin.examinations')
            , 'prescriptions' => $prescriptions, 'doctors' => $doctor,'patient'=>$patient]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.description');
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
        $prescription->patient_id=patient()->user()->id;
        $prescription->description=$request->description;
        $prescription->type=$request->type;
        $prescription->patient_id=$request->patient_id;
        $prescription->medicine_id=$request->medicine_id;
        $prescription->quantity=$request->quantity;
//
        $prescription->save();


        return redirect(url('patient/task'));
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
        return view("patients.editPrescription", compact('prescription', 'title'));
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
        $prescription->patient_id=patient()->user()->id;
        $prescription->description=$request->description;
        $prescription->type=$request->type;
        $prescription->patient_id=$request->patient_id;
        $prescription->medicine_id=$request->medicine_id;
        $prescription->quantity=$request->quantity;
//
        $prescription->save();


        return redirect(url('patient/task'));
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
        return redirect(url('patient/task'));
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


