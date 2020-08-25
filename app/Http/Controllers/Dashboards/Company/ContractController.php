<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Contract;
use App\Models\Employee;
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

class ContractController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'job_id' => 'required|numeric',
            'employee_id' => 'required|numeric'
        ]);
        $data['again'] = 0;
        $contract = Contract::where(['job_id' => $request->get('job_id')])->first();
        if ($contract) {
            $contract->update($data);
        }else {
            $contract = Contract::create($data);
        }

        $employee = Employee::find($contract->employee_id);

        // send notifications to admins to approve
        $data = [
            'title' => im('company')->name,
            'message' => 'ارسلت الشركة عرض تفاوض تحقق منه',
            'route' => 'employee.jobs.bids.index'
        ];

        Notification::send($employee, new NewJob($data));

    }
}
