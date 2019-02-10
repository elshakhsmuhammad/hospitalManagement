<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\BillDatatable;
use App\Http\Controllers\Controller;

use App\Bill;
use Illuminate\Http\Request;

class BillController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BillDatatable $Bill) {
        return $Bill->render('admin.bills.index', ['title' => trans('admin.bills')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.bills.create', ['title' => trans('admin.create_bills')]);
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
                'Bill_name_ar' => 'required',
                'Bill_name_en' => 'required',
                'country_id'   => 'required|numeric',

            ], [], [
                'Bill_name_ar' => trans('admin.Bill_name_ar'),
                'Bill_name_en' => trans('admin.Bill_name_en'),
                'country_id'   => trans('admin.country_id'),

            ]);

        Bill::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('bills'));
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
        $country = Bill::find($id);
        $title   = trans('admin.edit');
        return view('admin.bills.edit');
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
                'Bill_name_ar' => 'required',
                'Bill_name_en' => 'required',
                'country_id'   => 'required|numeric',

            ], [], [
                'Bill_name_ar' => trans('admin.Bill_name_ar'),
                'Bill_name_en' => trans('admin.Bill_name_en'),
                'country_id'   => trans('admin.country_id'),
            ]);

        Bill::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('bills'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $bills = Bill::find($id);

        $bills->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('bills'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $bills = Bill::find($id);
                $bills->delete();
            }
        } else {
            $bills = Bill::find(request('item'));
            $bills->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('bills'));
    }
}
