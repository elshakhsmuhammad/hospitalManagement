<?php

namespace App\Http\Controllers\Patient;
use App\Patient;
use  App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ExaminationsDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Storage;
//use App\Patient;
use App\Examination;
use Illuminate\Support\Facades\DB;

class PatientProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $patient = patient::find(patient()->user()->id);
        $examinations = patient::find(patient()->user()->id)->examinations;

        $doctor = DB::table('doctors')
            ->join('examinations', 'doctors.id', '=', 'examinations.doctor_id')
            ->select('doctors.*', 'examinations.id', 'examinations.description')
            ->get();
        return view('patients.home', ['title' => trans('admin.examinations')
            , 'examinations' => $examinations, 'doctors' => $doctor,'patient'=>$patient]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.profile');
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

                'doctor_id' => 'required|numeric',


            ]);
        $exam = new Examination();
        $exam->doctor_id = patient()->user()->id;
        $exam->description = $request->description;

        $exam->doctor_id = $request->doctor_id;
//
        $exam->save();


        return redirect(url('patient/patient'));
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
        return view("patients.editExamination", compact('examination', 'title'));
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

                'doctor_id' => 'required|numeric',


            ]);
        $exam = Examination::find($id);
        $exam->doctor_id = patient()->user()->id;
        $exam->description = $request->description;

        $exam->doctor_id = $request->doctor_id;
//
        $exam->save();
    }

     public function editPhoto($id)
    {
         $patient= patient::find($id);
         $title   = trans('admin.edit');
         return view("patients.editPhoto", compact('patient', 'title'));
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
            $request->file('image')->storeAs('app/public/patients/',$imageName,'public');
        }
            $patient = patient::find($id);
            $patient->name = patient()->user()->name;
            $patient->password = patient()->user()->password;
            $patient->description = patient()->user()->description;
            $patient->email = patient()->user()->email;
            $patient->phone = patient()->user()->phone;
            $patient->image = $request->image;


//
            $patient->save();


            return redirect(url('patient/patient'));
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
            return redirect(url('patient/patient'));
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