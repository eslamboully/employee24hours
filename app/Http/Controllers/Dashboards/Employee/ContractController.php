<?php

namespace App\Http\Controllers\Dashboards\Employee;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Language;
use App\Models\Job;
use App\Models\Bid;
use App\Models\JobType;
use App\Models\Convention;
use App\Notifications\NewJob;
use Astrotomic\Translatable\Locales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class ContractController extends Controller
{
    public function acceptContract($id)
    {
        // contract
        $contract = Contract::find($id);
        $contract->update(['accept' => 1]);

        // Job
        $job = Job::find($contract->job_id);
        $job->update(['status' => 1]);

        DB::table('company_employee')
            ->insert([
                'company_id' => $job->company_id,
                'employee_id' => im('employee')->id,
                'started_at' => Carbon::now()->toDateTimeString(),
                'salary_appointment_at' => Carbon::now()->addMonths(1)->toDateTimeString(),
                'salary' => $job->salary
                ]);

        // Roles
        if ($job->helper_type == 1) {
            im('employee')->assignRole('first_helper_category');
        }elseif($job->helper_type == 2) {
            im('employee')->assignRole('second_helper_category');
        }elseif($job->helper_type == 3) {
            im('employee')->assignRole('third_helper_category');
        }

        $company = Company::find($job->company_id);

        // send notifications to admins to approve
        $data = [
            'title' => $job->title,
            'message' => 'تهانينا وافق الموظف علي العرض',
            'route' => 'company.jobs.bids.index'
        ];

        Notification::send($company, new NewJob($data));


        Session::flash('success', 'Accepted Successfully');
        return redirect()->back();
    }

    public function refuseContract(Request $request)
    {
        $contract = Contract::find($request->get('contract_id'));
        $contract->update(['refusal_details'=> $request->get('refusal_details'),'again' => 1]);

        $job = Job::find($contract->job->id);
        $company = Company::find($job->company_id);

        // send notifications to admins to approve
        $data = [
            'title' => $job->title,
            'message' => 'رفض الموظف العرض تحقق من المتطلبات الجديدة',
            'route' => 'employee.jobs.bids.index'
        ];

        Notification::send($company, new NewJob($data));


        return response()->json(['data' => $contract,'message' => '','status'=> true]);
    }
}
