<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\PurchasesDatatable;
use App\Http\Controllers\Controller;

use App\Purchas;
use Illuminate\Http\Request;

class PurchasesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PurchasesDatatable $admin) {
        return $admin->render('admin.purchases.index', ['title' => trans('admin.purchases')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {

       
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
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id) {

       
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $purchas = Purchas::find($id);

        $purchas->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('purchases'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $purchas = Purchas::find($id);
                $purchas->delete();
            }
        } else {
            $purchas = Purchas::find(request('item'));
            $purchas->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('purchases'));
    }
}
