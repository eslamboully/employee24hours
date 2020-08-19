<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Language;
use App\Models\Job;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('type')) {
            $type = Job::find(request('type'));
            if ($type) {
                $elements = $type->children;
            }
        } else {
            $type = null;
            $elements = Job::with(['translations'])
                ->where('parent_id',null)
                ->get();
        }
        return view('Company.job-types.index',compact('elements','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Job::where('parent_id',null)->get();

        return view('Company.job-types.create',compact('categories'));
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

        $jobtype = new Job();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $jobtype->translateOrNew($lang)->title = $data[$lang]['title'];
        }
        // Save Other Tables
        $jobtype->company_id = auth('company')->user()->id;

        if ($request->has('parent_id')) {
            $jobtype->parent_id = $request->get('parent_id');
        }

        // Save The Model
        $jobtype->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.job-types.index');
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
        $element = Job::find($id);
        $categories = Job::where('parent_id',null)->get();
        return view('Company.job-types.edit',compact('element','categories'));
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

        $jobtype = Job::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $jobtype->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        $jobtype->company_id = auth('company')->user()->id;

        if ($request->has('parent_id')) {
            $jobtype->parent_id = $request->get('parent_id');
        }

        // Save The Model
        $jobtype->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.job-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $jobtype = Job::find($id);
        $jobtype->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.job-types.index');
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
