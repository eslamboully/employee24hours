<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Agreement;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Agreement::with(['translations'])->get();
        if (im('admin')->hasPermissionTo('read_agreements')) {
            return view('Admin.agreements.index',compact('elements'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (im('admin')->hasPermissionTo('create_agreements')) {
            return view('Admin.agreements.create');
        } else {
            abort(403);
        }
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

        $agreement = new Agreement();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $agreement->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Save The Model
        $agreement->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.agreements.index');
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
        $element = Agreement::find($id);
        if (im('admin')->hasPermissionTo('update_agreements')) {
            return view('Admin.agreements.edit',compact('element'));
        } else {
            abort(403);
        }
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

        $agreement = Agreement::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $agreement->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Save The Model
        $agreement->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.agreements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $agreement = Agreement::find($id);
        $agreement->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.agreements.index');
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
