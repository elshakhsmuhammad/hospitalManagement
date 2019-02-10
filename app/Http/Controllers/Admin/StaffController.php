<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\StaffDatatable;
use App\Http\Controllers\Controller;
use App\Staff;
use Illuminate\Http\Request;
use Storage;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StaffDataTable $admin)
    {
        return $admin->render('admin.staff.index', ['title' => trans('admin.staff')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.staff.create', ['title' => trans('admin.create_staff')]);
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
                  'icon' => 'sometimes|nullable|min:6',
                   
                'job'    => 'required|in:nursing,management,worker',
                'phone' => 'required|min:9', //nursing,management,worker
                'email'    => 'required|email|unique:staff',
                
            ], [], [
                'name'       => trans('admin.name'),
                'password'   => trans('admin.password'),
                'icon'       => trans('admin.icon'),
                'job'        => trans('admin.job'),
                'phone'      => trans('admin.phone'),
                'gender'     => trans('admin.gender'),
                'email'      => trans('admin.email'),
               
            ]);
        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'staff',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
        }
        $data['password'] = bcrypt(request('password'));
        Staff::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('staff'));
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
        $staff  = Staff::find($id);
        $title = trans('admin.edit');
        return view('admin.staff.edit', compact('staff', 'title'));
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
                  'icon' => 'sometimes|nullable|min:6',
                   
                'job'    => 'required|in:nursing,management,worker',
                'phone' => 'required|min:9',
                'email'    => 'required|email|unique:staff,email,'.$id,
             
            ], [], [
                'name'       => trans('admin.name'),
                'password'   => trans('admin.password'),
                'icon'       => trans('admin.icon'),
                'job'        => trans('admin.job'),
                'phone'      => trans('admin.phone'),
                'gender'     => trans('admin.gender'),
                'email'      => trans('admin.email'),
            ]);
        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'staff',
                    'upload_type' => 'single',
                    'delete_file' => Staff::find($id)->icon,
                ]);
        }
        if (request()->has('password')) {
            $data['password'] = bcrypt(request('password'));
        }
        Staff::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('staff'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Staff::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('staff'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            Staff::destroy(request('item'));
        } else {
            Staff::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('staff'));
    }
}
