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
}
