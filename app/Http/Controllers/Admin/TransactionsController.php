<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\TransactionsDatatable;
use App\Http\Controllers\Controller;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionDatatable $admin) {
        return $admin->render('admin.transactions.index', ['title' => trans('admin.Transactions')]);
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
        $transaction = Transaction::find($id);

        $transaction->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('transactions'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $transaction = Transaction::find($id);
                $transaction->delete();
            }
        } else {
            $transaction = Transaction::find(request('item'));
            $transaction->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('transactions'));
    }
}
