<?php

namespace App\Http\Controllers\Doctor;
use App\Doctor;
use  App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ExaminationsDatatable;
use App\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


use App\Examination;
use Illuminate\Support\Facades\DB;

class DoctorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $doctor  = doctor()->user()->id;
        $title = trans('admin.edit');
        return view('doctors.editPhoto', compact('doctor', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id) {
        $doctor  = Doctor::find($id);
        $title = trans('admin.edit');
        return view('doctors.editPhoto', compact('doctor', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id) {

        $data = $this->validate(request(),
            [
                'name'     => 'required',
                'password' => 'sometimes|nullable|min:6',
                'image'            => 'sometimes|nullable|'.v_image(),

                'specialized'    => 'required',
                'phone' => 'required|min:9',
                'email'    => 'required|email|unique:doctors,email,'.$id,

            ], [], [
                'name'       => trans('admin.name'),
                'password'   => trans('admin.password'),
                'image'       => trans('admin.image'),
                'specialized'        => trans('admin.specialized'),
                'phone'      => trans('admin.phone'),
                'gender'     => trans('admin.gender'),
                'email'      => trans('admin.email'),
            ]);
        if (request()->hasFile('image')) {
            $data['image'] = up()->upload([
                'file'        => 'image',
                'path'        => 'photos',
                'upload_type' => 'single',
                'visibility' => 'public',
                'delete_file' => Doctor::find($id)->image,
            ]);
        }

        if (request()->has('password')) {
            $data['password'] = bcrypt(request('password'));
        }
        Doctor::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(url('doctor/info'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
