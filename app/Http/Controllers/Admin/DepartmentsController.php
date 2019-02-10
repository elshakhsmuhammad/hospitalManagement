<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\DepartmentDatatable;
use App\Http\Controllers\Controller;

use App\Model\Department;
use Illuminate\Http\Request;
use Storage;

class DepartmentsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(DepartmentDatatable $admin) {
		return $admin->render('admin.departments.index', ['title' => trans('admin.departments')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.departments.create', ['title' => trans('admin.add')]);
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
				'name' => 'required',
				
				
				'icon'        => 'sometimes|nullable|'.v_image(),
				'capacity' => 'sometimes|nullable',
				'keyword'     => 'sometimes|nullable',

			], [], [
				'dep_name_ar' => trans('admin.dep_name_ar'),
				'dep_name_en' => trans('admin.dep_name_en'),
				'parent'      => trans('admin.parent'),
				'icon'        => trans('admin.icon'),
				'capacity' => trans('admin.capacity'),
				'keyword'     => trans('admin.keyword'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'departments',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Department::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('departments'));
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
		$department = Department::find($id);
		$title      = trans('admin.edit');
		return view('admin.departments.edit', compact('department', 'title'));
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
				'name' => 'required',
				
				
				'icon'        => 'sometimes|nullable',
				'capacity' => 'sometimes|nullable',
				
			], [], [
				'name' => trans('admin.name'),
				
				
				'icon'        => trans('admin.icon'),
				'capacity' => trans('admin.capacity'),
				
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'departments',
					'upload_type' => 'single',
					'delete_file' => Department::find($id)->icon,
				]);
		}

		Department::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('departments'));
	}

	public function destroy($id) {
		Department::find($id)->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('departments'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			Department::destroy(request('item'));
		} else {
			Department::find(request('item'))->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('departments'));
	}
}