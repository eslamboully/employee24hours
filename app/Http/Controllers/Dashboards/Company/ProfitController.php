<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Language;
use App\Models\Job;
use App\Models\Bid;
use App\Models\Convention;
use App\Models\Profit;
use App\Notifications\NewJob;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ProfitController extends Controller
{
    public function profitIndex()
    {
        $elements = Profit::whereHas('job', function ($q) {
            return $q->whereHas('convention', function ($query) {
                return $query->where('agreement_id',3);
            })->where('company_id', im('company')->id);
        })->get();
        return view('Company.profits.index',compact('elements'));
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
