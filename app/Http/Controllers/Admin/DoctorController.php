<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\DoctorDatatable;
use App\Http\Controllers\Controller;
use App\Doctor;
use Illuminate\Http\Request;
use Storage;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorDataTable $admin)
    {
        return $admin->render('admin.doctors.index', ['title' => trans('admin.doctors')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.doctors.create', ['title' => trans('admin.add')]);
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
                'image'            => 'sometimes|nullable|'.v_image(),

                'specialized'    => 'required',
                'phone' => 'required|min:9', //nursing,management,worker
                'email'    => 'required|email|unique:doctors',

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
                'delete_file' => '',
            ]);
        }
        $data['password'] = bcrypt(request('password'));
        Doctor::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('doctors'));
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
        $doctor  = Doctor::find($id);
        $title = trans('admin.edit');
        return view('admin.doctors.edit', compact('doctor', 'title'));
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
        return redirect(aurl('doctors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Doctor::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('doctors'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            Doctor::destroy(request('item'));
        } else {
            Doctor::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('doctors'));
    }
}
