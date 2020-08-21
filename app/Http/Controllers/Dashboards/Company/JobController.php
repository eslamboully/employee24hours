<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Language;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Convention;
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
            $elements = Job::with(['translations'])
                ->where('company_id',im('company')->id)
                ->get();

        return view('Company.jobs.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = JobType::where('parent_id', null)->get();
        $conventions = Convention::all();

        return view('Company.jobs.create',compact('parents','conventions'));
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
            'job_type_id' => 'required|numeric',
            'convention_id' => 'required|numeric',
            'work_from' => 'required',
            'work_to' => 'required',
            'work_days_in_week' => 'required|numeric',
            'salary' => 'required|numeric',
            'helper_type' => 'sometimes|numeric',
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $job = new Job();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $job->translateOrNew($lang)->title = $data[$lang]['title'];
            $job->translateOrNew($lang)->description = $data[$lang]['description'];
        }
        // Save Other Tables
        $job->company_id = auth('company')->user()->id;
        $job->job_type_id = $data['job_type_id'];
        $job->convention_id = $data['convention_id'];
        $job->work_from = $data['work_from'];
        $job->work_to = $data['work_to'];
        $job->work_days_in_week = $data['work_days_in_week'];
        $job->salary = $data['salary'];
        $job->helper_type = $data['helper_type'];

        // Save The Model
        $job->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.jobs.index');
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
        $element = Job::where(['id' => $id,'company_id' => im('company')->id,'status' => 3])->first();
        $conventions = Convention::all();

        return view('Company.jobs.edit',compact('element','conventions'));
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
            'convention_id' => 'required|numeric',
            'work_from' => 'required',
            'work_to' => 'required',
            'work_days_in_week' => 'required|numeric',
            'salary' => 'required|numeric',
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $job = Job::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $job->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        $job->convention_id = $data['convention_id'];
        $job->work_from = $data['work_from'];
        $job->work_to = $data['work_to'];
        $job->work_days_in_week = $data['work_days_in_week'];
        $job->salary = $data['salary'];
        $job->status = 0;

        // Save The Model
        $job->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.jobs.index');
    }

    public function parent_ajax($id)
    {
        $parent = JobType::find($id);
        $parent->children;

        return response()->json(['data' => $parent->children,'message' => null , 'status' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $job = Job::find($id);
        $job->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.jobs.index');
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
