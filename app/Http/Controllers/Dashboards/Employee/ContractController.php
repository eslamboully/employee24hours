<?php

namespace App\Http\Controllers\Dashboards\Employee;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Contract;
use App\Models\Language;
use App\Models\Job;
use App\Models\Bid;
use App\Models\JobType;
use App\Models\Convention;
use Astrotomic\Translatable\Locales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller
{
    public function acceptContract($id)
    {
        // contract
        $contract = Contract::find($id);
        $contract->update(['accept' => 1]);

        // Job
        $job = Job::find($contract->job_id);

        DB::table('company_employee')
            ->insert([
                'company_id' => $job->company_id,
                'employee_id' => im('employee')->id,
                'started_at' => Carbon::now()->toDateTimeString(),
                'salary_appointment_at' => Carbon::now()->addMonths(1)->toDateTimeString(),
                'salary' => $job->salary
                ]);
        Session::flash('success', 'Accepted Successfully');
        return redirect()->back();
    }

    public function refuseContract(Request $request)
    {
        $contract = Contract::find($request->get('contract_id'));
        $contract->update(['refusal_details'=> $request->get('refusal_details'),'again' => 1]);

        return response()->json(['data' => $contract,'message' => '','status'=> true]);
    }
}
