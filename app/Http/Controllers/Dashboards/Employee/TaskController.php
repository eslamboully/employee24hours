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
}
