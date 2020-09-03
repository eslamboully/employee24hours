<?php

namespace App\Http\Controllers\Dashboards\Employee;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Profit;

class ProfitController extends Controller
{
    public function profitIndex()
    {
        $elements = Profit::where('employee_id',im('employee')->id)
            ->whereHas('job', function ($q) {
            return $q->whereHas('convention', function ($query) {
                return $query->where('agreement_id',3);
            });
        })->get();
        return view('Employee.profits.index',compact('elements'));
    }

    public function langs_rules()
    {
        $langs = Language::all();
        $rules = [];

        foreach ($langs as $lang) {
            $rules[$lang->locale . '.*'] = 'required';
        }

        return $rules;
    }
}
