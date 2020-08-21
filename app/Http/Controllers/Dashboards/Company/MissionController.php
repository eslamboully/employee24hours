<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Language;
use App\Models\Product;
use App\Models\Mission;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Mission::with(['translations'])->withTrashed()->where('company_id',auth('company')->user()->id)->get();
        return view('Company.missions.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.missions.create');
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

        $mission = new Mission();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $mission->translateOrNew($lang)->mission = $data[$lang]['mission'];
        }

        // Other Columns
        $mission->company_id = auth('company')->user()->id;

        // Save The Model
        $mission->save();


        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.missions.index');
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
        $element = Mission::find($id);
        return view('Company.missions.edit',compact('element'));
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
            'status' => 'required|numeric',
        ];

        $data = $request->validate(array_merge($langs_rules,$rules));

        $mission = Mission::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $mission->translateOrNew($lang)->title = $data[$lang]['mission'];
        }

        // Other Columns
        $mission->company_id = auth('company')->user()->id;
        $mission->status = $data['status'];


        // Save The Model
        $mission->save();

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.missions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id = null)
    {
        $mission = Mission::find($id);
        $mission->update(['status' => 1]);

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.missions.index');
    }

    public function destroy($id = null)
    {
        $mission = Mission::find($id);
        $mission->update(['status' => 2]);

        Session::flash('success', 'Updated Successfully');
        return redirect()->route('company.missions.index');
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
