<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\PatientDatatable;
use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatientDatatable $admin)
    {
        return $admin->render('admin.patients.index', ['title' => trans('admin.patients')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.patients.create', ['title' => trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $data = $this->validate(request(),
            [
                'name'     => 'required',
                'password' => 'sometimes|nullable|min:6',
                'icon' => 'sometimes|nullable|'.v_image(),

                'description'    => 'required',
                'phone' => 'required|min:9', //nursing,management,worker
                'department_id'   => 'required|numeric',
                'email'    => 'required|email|unique:patients',


            ], [], [
                'name'       => trans('admin.name'),
                'password'   => trans('admin.password'),
                'icon'       => trans('admin.icon'),
                'description'        => trans('admin.description'),
                'phone'      => trans('admin.phone'),
                'gender'     => trans('admin.gender'),
                'department_id'   => trans('admin.department_id'),
                'email'      => trans('admin.email'),

            ]);
        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'patients',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
        }
        $data['password'] = bcrypt(request('password'));
        Patient::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('patients'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $patient  = Patient::find($id);
        $title = trans('admin.edit');
        return view('admin.patients.edit', compact('patient', 'title'));
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
                'icon' => 'sometimes|nullable|'.v_image(),

                'description'    => 'required',
                'phone' => 'required|min:9',
                'department_id'   => 'required|numeric',
                'email'    => 'required|email|unique:patients,email,'.$id,

            ], [], [
                'name'       => trans('admin.name'),
                'password'   => trans('admin.password'),
                'icon'       => trans('admin.icon'),
                'description'        => trans('admin.description'),
                'phone'      => trans('admin.phone'),
                'gender'     => trans('admin.gender'),
                'department_id'   => trans('admin.department_id'),
                'email'      => trans('admin.email'),

            ]);

       if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'patients',
                    'upload_type' => 'single',
                    'delete_file' => Patient::find($id)->icon,
                ]);
        }
        if (request()->has('password')) {
            $data['password'] = bcrypt(request('password'));
        }
        Patient::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('patients'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Patient::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('patients'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            Patient::destroy(request('item'));
        } else {
            patient::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('patients'));
    }
}
