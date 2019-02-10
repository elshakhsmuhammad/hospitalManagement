<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\MedicineDatatable;
use App\Http\Controllers\Controller;

use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MedicineDatatable $admin) {
        return $admin->render('admin.medicines.index', ['title' => trans('admin.medicines')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.medicines.create', ['title' => trans('admin.create_medicines')]);
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
                'description' => 'sometimes|nullable|min:6',
                'type'    => 'required|in:injection,capsules,drink',
                'icon' => 'sometimes|nullable|min:6',

                'quantity'    => 'required',
                'price' => 'required', //nursing,management,worker
                'expired'    => 'sometimes|nullable',

            ], [], [
                'name'       => trans('admin.name'),
                'description'   => trans('admin.description'),
                'type'   => trans('admin.type'),
                'icon'       => trans('admin.icon'),
                'quantity'        => trans('admin.quantity'),
                'price'      => trans('admin.price'),

            ]);

        Medicine::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('medicines'));
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
        $medicine = Medicine::find($id);
        $title   = trans('admin.edit');
        return view('admin.medicines.edit', compact('medicine', 'title'));
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
                'description' => 'sometimes|nullable|min:6',
                'type'    => 'required|in:injection,capsules,drink',
                'icon' => 'sometimes|nullable|min:6',

                'quantity'    => 'required',
                'price' => 'required', //nursing,management,worker
                'expired'    => 'sometimes|nullable',

            ], [], [
                'name'       => trans('admin.name'),
                'description'   => trans('admin.description'),
                'type'   => trans('admin.type'),
                'icon'       => trans('admin.icon'),
                'quantity'        => trans('admin.quantity'),
                'price'      => trans('admin.price'),


            ]);

        Medicine::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('medicines'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $medicine = Medicine::find($id);

        $medicine->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('medicines'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $medicine = Medicine::find($id);
                $medicine->delete();
            }
        } else {
            $medicine = Medicine::find(request('item'));
            $medicine->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('medicines'));
    }
}
