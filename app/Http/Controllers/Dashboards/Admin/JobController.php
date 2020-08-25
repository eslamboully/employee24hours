<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Language;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Convention;
use App\Notifications\NewJob;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function index()
    {
        $elements = Job::with(['translations'])->get();
        return view('Admin.jobs.index',compact('elements'));
    }

    public function show($id)
    {

    }

    public function accept(Request $request)
    {
        $job = Job::find($request->get('id'));

        $job->update(['status' => 4]);

        $companies = Company::find($job->company_id);

        // send notifications to companies to approve
        $data = [
            'title' => 'موظفين 24 ساعة',
            'message' => 'تهانينا تم نشر الوظيفة',
            'route' => 'company.jobs.index'
        ];

        Notification::send($companies, new NewJob($data));

        return response()->json(['data' => $job,'message' => null,'status' => 1]);
    }

    public function refuse(Request $request)
    {
        $job = Job::find($request->get('id'));
        $job->update(['status' => 3,'refusal_details' => $request->get('refusal_details')]);

        $companies = Company::find($job->company_id);

        // send notifications to companies to approve
        $data = [
            'title' => 'تم رفض الوظيفة السبب :',
            'message' => $request->get('refusal_details'),
            'route' => 'company.jobs.index'
        ];

        Notification::send($companies, new NewJob($data));

        return response()->json(['data' => $job,'message' => null,'status' => 1]);
    }
}
