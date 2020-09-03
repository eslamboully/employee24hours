<?php

namespace App\Http\Controllers\Dashboards\Company;

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
use App\Models\Profit;
use App\Models\Task;
use App\Notifications\NewJob;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index($id)
    {
        $job = Job::find($id);
        return view('Company.jobs.tasks.index',compact('job'));
    }

    public function create($id)
    {
        $job = Job::find($id);
        return view('Company.jobs.tasks.create',compact('job'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'job_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'price' => 'sometimes|nullable',
            'deadline' => 'sometimes|nullable'
        ]);

        $task = Task::create($data + ['company_id' => im('company')->id]);
        $employee = Employee::find($request->get('employee_id'));

        // send notifications to admins to approve
        $data = [
            'title' => im('company')->name,
            'message' => 'تم اضافة مهمة جديدة من الشركة',
            'route' => 'employee.tasks.index'
        ];

        Notification::send($employee, new NewJob($data));

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.job.tasks.index',$task->job_id);
    }

    public function acceptTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 2]);

        $job = Job::find($task->job_id);

        if ($task->job->convention->agreement_id == 3) {
            $profit = Profit::create([
                'price' => $task->price,
                'employee_id' => $task->employee_id,
                'job_id' => $task->job_id,
                'contract_id' => $task->job->contract->id,
            ]);
        }


        $company = Company::find($task->company_id);
        // send notifications to admins to approve
        $data = [
            'title' => im('company')->name,
            'message' => 'تم استلام المهمة من الشركة بنجاح',
            'route' => 'employee.jobs.index'
        ];

        Notification::send($company, new NewJob($data));

        Session::flash('success', 'Task Accepted Successfully');

        return redirect()->back();
    }

    public function refuseTask(Request $request)
    {
        $task = Task::find($request->get('task_id'));
        $task->update(['status' => 3,'refusal_details' => $request->get('refusal_details')]);

        $company = Company::find($task->company_id);
        // send notifications to admins to approve
        $data = [
            'title' => im('company')->name,
            'message' => 'تم استلام المهمة من الشركة بنجاح',
            'route' => 'employee.jobs.index'
        ];

        Notification::send($company, new NewJob($data));

        Session::flash('success', 'Task Refused Successfully');

        return redirect()->back();
    }
}
