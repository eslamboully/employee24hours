<?php

namespace App\Http\Controllers\Dashboards\Employee;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Language;
use App\Models\Job;
use App\Models\Bid;
use App\Models\JobType;
use App\Models\Convention;
use App\Notifications\NewJob;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function jobIndex()
    {
        $elements = Job::with(['translations'])->doesnthave('contract')->get();
        return view('Employee.jobs.index',compact('elements'));
    }

    public function show($id)
    {
        $element = Job::find($id);
        $bid = Bid::where(['job_id' => $element->id, 'employee_id' => im('employee')->id])->first();
        $elementWorkFrom = date('H:i:s', strtotime($element->work_from));
        $employeeWorkFrom = date('H:i:s', strtotime(im('employee')->work_from));

        $elementWorkTo = date('H:i:s', strtotime($element->work_to));
        $employeeWorkTo = date('H:i:s', strtotime(im('employee')->work_to));

        return view('Employee.jobs.show',compact(
            'element',
            'bid',
            'elementWorkFrom',
            'employeeWorkFrom',
            'elementWorkTo',
            'employeeWorkTo'
        ));
    }

    public function createBids(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'job_id' => 'required',
        ]);

        $bid = Bid::create($data + ['employee_id' => im('employee')->id]);

        $company = Company::find($bid->job->company_id);

        // send notifications to admins to approve
        $data = [
            'title' => im('employee')->name,
            'message' => 'قام بتقديم عرض لوظيفة',
            'route' => 'company.jobs.index'
        ];

        Notification::send($company, new NewJob($data));

        Session::flash('success', 'Successfully');
        return redirect()->back();
    }

    public function indexBids()
    {
        $bids = Bid::where(['employee_id' => im('employee')->id,'status' => 0])->get();
        return view('Employee.jobs.bids.index',compact('bids'));
    }

    public function create()
    {
        $conventions = Convention::all();

        return view('Employee.jobs.create',compact('parents','conventions'));
    }

    public function relatedCompanies()
    {
        return view('Employee.related-companies.index');
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
