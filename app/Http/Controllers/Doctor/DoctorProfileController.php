<?php

namespace App\Http\Controllers\Doctor;
use App\Doctor;
use  App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ExaminationsDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Storage;
use App\Patient;
use App\Examination;
use Illuminate\Support\Facades\DB;

class DoctorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $doctor = doctor::find(doctor()->user()->id);
        $examinations = doctor::find(doctor()->user()->id)->examinations;

        $patient = DB::table('patients')
            ->join('examinations', 'patients.id', '=', 'examinations.patient_id')
            ->select('patients.*', 'examinations.id', 'examinations.description')
            ->get();
        return view('doctors.home', ['title' => trans('admin.examinations')
            , 'examinations' => $examinations, 'patients' => $patient,'doctor'=>$doctor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
            [

                'description' => 'required',

                'patient_id' => 'required|numeric',


            ]);
        $exam = new Examination();
        $exam->doctor_id = doctor()->user()->id;
        $exam->description = $request->description;

        $exam->patient_id = $request->patient_id;
//
        $exam->save();


        return redirect(url('doctor/doctor'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examination = Examination::find($id);
        $title = trans('admin.edit');
        return view("doctors.editExamination", compact('examination', 'title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [

                'description' => 'required',

                'patient_id' => 'required|numeric',


            ]);
        $exam = Examination::find($id);
        $exam->doctor_id = doctor()->user()->id;
        $exam->description = $request->description;

        $exam->patient_id = $request->patient_id;
//
        $exam->save();
        return redirect(url('doctor/doctor'));
    }

     public function editPhoto($id)
    {
         $doctor= doctor::find($id);
         $title   = trans('admin.edit');
         return view("doctors.editPhoto", compact('doctor', 'title'));
     }
    public function upload(Request $request, $id)
    {
        $data = $this->validate(request(),
            [

                'image' => 'required' ,


            ]);
        if ($request->hasFile('image')){
            $fileObject=$request->file('image');
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageName = time().'photo.'.$imageExt;
            $request->file('image')->storeAs('app/public/photos/',$imageName,'public');
        }
            $doctor = Doctor::find($id);
            $doctor->name = doctor()->user()->name;
            $doctor->password = doctor()->user()->password;
            $doctor->specialized = doctor()->user()->specialized;
            $doctor->email = doctor()->user()->email;
            $doctor->phone = doctor()->user()->phone;
            $doctor->image = $request->image;


//
            $doctor->save();


            return redirect(url('doctor/doctor'));
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public
        function deleteIt($id)
        {
            $examination = Examination::find($id);

            $examination->delete($id);
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(url('doctor/doctor'));
        }

        public
        function multi_delete()
        {
            if (is_array(request('item'))) {
                foreach (request('item') as $id) {
                    $examinations = Examination::find($id);
                    $examinations->delete();
                }
            } else {
                $examinations = Examination::find(request('item'));
                $examinations->delete();
            }
            session()->flash('success', trans('admin.deleted_record'));
            //advanced  in project return redirect(url('examinations'));
        }


}