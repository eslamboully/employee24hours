<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Language;
use App\Models\Corporation;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CorporationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Corporation::with(['translations'])->get();
        return view('Company.corporations.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.corporations.create');
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

        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $convention = new Corporation();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $convention->translateOrNew($lang)->title = $data[$lang]['title'];
            $convention->translateOrNew($lang)->description = $data[$lang]['description'];
        }
        // Save Other Tables
        $convention->company_id = auth('company')->user()->id;

        // Save The Model
        $convention->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.corporations.index');
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
        $element = Corporation::find($id);
        $corporation = Agreement::get();
        return view('Company.corporations.edit',compact('element','corporation'));
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

        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $convention = Corporation::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $convention->translateOrNew($lang)->title = $data[$lang]['title'];
            $convention->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        $convention->company_id = auth('company')->user()->id;
        // Save The Model
        $convention->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.corporations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $convention = Corporation::find($id);
        $convention->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.corporations.index');
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
