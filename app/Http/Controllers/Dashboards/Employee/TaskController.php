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
use App\Models\Task;
use App\Notifications\NewJob;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index()
    {
        return view('Employee.jobs.tasks.index');
    }

    public function finishTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 1]);

        $company = Company::find($task->company_id);
        // send notifications to admins to approve
        $data = [
            'title' => im('employee')->name,
            'message' => 'ارسل الموظف طلب استلام لمهمة',
            'route' => 'company.jobs.index'
        ];

        Notification::send($company, new NewJob($data));

        Session::flash('success', 'Requested Finish Successfully');

        return redirect()->back();
    }
}
