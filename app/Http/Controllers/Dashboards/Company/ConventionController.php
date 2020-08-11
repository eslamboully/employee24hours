<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Language;
use App\Models\Convention;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Convention::with(['translations'])->get();
        return view('Company.conventions.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agreements = Agreement::get();
        return view('Company.conventions.create',compact('agreements'));
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
        $rules = [
            'agreement_id' => 'required|numeric',
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $convention = new Convention();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $convention->translateOrNew($lang)->main_items = $data[$lang]['main_items'];
            $convention->translateOrNew($lang)->sub_items = $data[$lang]['sub_items'];
        }
        // Save Other Tables
        $convention->agreement_id = $data['agreement_id'];

        // Save The Model
        $convention->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.conventions.index');
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
        $element = Convention::find($id);
        $agreements = Agreement::get();
        return view('Company.conventions.edit',compact('element','agreements'));
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
        $rules = [
            'agreement_id' => 'required|numeric',
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $convention = Convention::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $convention->translateOrNew($lang)->main_items = $data[$lang]['main_items'];
            $convention->translateOrNew($lang)->sub_items = $data[$lang]['sub_items'];
        }

        $convention->agreement_id = $data['agreement_id'];
        // Save The Model
        $convention->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.conventions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $convention = Convention::find($id);
        $convention->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.conventions.index');
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
