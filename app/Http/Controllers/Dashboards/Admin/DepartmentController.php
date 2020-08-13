<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Department;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Department::with(['translations'])->get();
        return view('Admin.departments.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $langs_rules = $this->langs_rules();
        $rules = [];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $agreement = new Department();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $agreement->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Save The Model
        $agreement->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.departments.index');
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
    public function edit($id)
    {
        $element = Department::find($id);
        return view('Admin.departments.edit',compact('element'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $langs_rules = $this->langs_rules();
        $rules = [];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $agreement = Department::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $agreement->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Save The Model
        $agreement->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $agreement = Department::find($id);
        $agreement->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.departments.index');
    }

    public function langs_rules()
    {
        $langs = Language::all();
        $rules = [];

        foreach ($langs as $lang) {
            $rules[$lang->locale . '.*'] = 'required';
        }

        return $rules;
    }
}
