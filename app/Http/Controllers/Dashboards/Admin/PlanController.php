<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Plan;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Plan::with(['translations'])->get();
        return view('Admin.plans.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.plans.create');
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
            'price' => 'required|numeric',
            'number_of_jobs' => 'required|numeric'
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $plan = new Plan();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $plan->translateOrNew($lang)->title = $data[$lang]['title'];
            $plan->translateOrNew($lang)->description = $data[$lang]['description'];
            $plan->translateOrNew($lang)->salary_type = $data[$lang]['salary_type'];
        }
        // Save Other Tables
        $plan->price = $data['price'];
        $plan->number_of_jobs = $data['number_of_jobs'];

        // Save The Model
        $plan->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.plans.index');
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
        $element = Plan::find($id);
        return view('Admin.plans.edit',compact('element'));
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
            'price' => 'required|numeric',
            'number_of_jobs' => 'required|numeric'
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $plan = Plan::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $plan->translateOrNew($lang)->title = $data[$lang]['title'];
            $plan->translateOrNew($lang)->description = $data[$lang]['description'];
            $plan->translateOrNew($lang)->salary_type = $data[$lang]['salary_type'];
        }
        // Save Other Tables
        $plan->price = $data['price'];
        $plan->number_of_jobs = $data['number_of_jobs'];

        // Save The Model
        $plan->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $plan = Plan::find($id);
        $plan->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.plans.index');
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
