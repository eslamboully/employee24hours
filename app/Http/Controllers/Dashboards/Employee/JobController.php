<?php

namespace App\Http\Controllers\Dashboards\Employee;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Language;
use App\Models\Job;
use App\Models\Bid;
use App\Models\JobType;
use App\Models\Convention;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function jobIndex()
    {
        $elements = Job::with(['translations'])->get();
        return view('Employee.jobs.index',compact('elements'));
    }

    public function show($id)
    {
        $element = Job::find($id);
        $bid = Bid::where(['job_id' => $element->id, 'employee_id' => im('employee')->id])->first();
        return view('Employee.jobs.show',compact('element','bid'));
    }

    public function createBids(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'job_id' => 'required',
        ]);

        Bid::create($data + ['employee_id' => im('employee')->id]);

        Session::flash('success', 'Successfully');
        return redirect()->back();
    }

    public function create()
    {
        $conventions = Convention::all();

        return view('Employee.jobs.create',compact('parents','conventions'));
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
