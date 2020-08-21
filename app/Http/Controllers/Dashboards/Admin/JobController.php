<?php

namespace App\Http\Controllers\Dashboards\Admin;

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
    public function index()
    {
            $elements = Job::with(['translations'])->get();

        return view('Admin.jobs.index',compact('elements'));
    }

    public function show($id)
    {
        //
    }

    public function refuse(Request $request)
    {
        $job = Job::find($request->get('id'))
        ->update(['status' => 3,'refusal_details' => $request->get('refusal_details')]);

        return response()->json(['data' => $job,'message' => null,'status' => 1]);
    }
}
