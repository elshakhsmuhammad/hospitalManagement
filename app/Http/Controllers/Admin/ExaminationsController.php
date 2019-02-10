<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\ExaminationsDatatable;
use App\Http\Controllers\Controller;

use App\Examination;
use Illuminate\Http\Request;

class ExaminationsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExaminationsDatatable $Examination) {
        return $Examination->render('admin.examinations.index', ['title' => trans('admin.examinations')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.examinations.create', ['title' => trans('admin.create_examinations')]);
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
        $examinations = Examination::find($id);

        $examinations->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('examinations'));
    }

    public function multi_delete() {
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
        return redirect(aurl('examinations'));
    }
}
