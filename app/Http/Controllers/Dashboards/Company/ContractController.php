<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Contract;
use App\Models\Language;
use App\Models\Job;
use App\Models\Bid;
use App\Models\JobType;
use App\Models\Convention;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
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
        Contract::create($data);
    }
}
