<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Plan;
use App\Models\Service;
use App\Models\ServiceCategory;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Service::with(['translations'])->get();
        return view('Company.services.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ServiceCategory::where('company_id',auth('company')->user()->id)->get();
        return view('Company.services.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $langs_rules = $this->langs_rules();
        $rules = [
            'price' => 'required|numeric',
            'file' => 'required|mimes:pdf,doc,jpg,jpeg,png,zip,rar',
            'time' => 'required',
            'service_category_id' => 'required|numeric',
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $service = new Service();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $service->translateOrNew($lang)->title = $data[$lang]['title'];
            $service->translateOrNew($lang)->description = $data[$lang]['description'];
        }
        // Save Other Tables
        if ($request->file('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/services/files');
            $image->move($destinationPath, $name);
            $service->file = $name;
        }

        $service->price = $data['price'];
        $service->time = $data['time'];
        $service->service_category_id = $data['service_category_id'];
        $service->company_id = auth('company')->user()->id;

        // Save The Model
        $service->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Service::find($id);
        $categories = ServiceCategory::where('company_id',auth('company')->user()->id)->get();
        return view('Company.services.edit',compact('element','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $langs_rules = $this->langs_rules();
        $rules = [
            'price' => 'required|numeric',
            'number_of_jobs' => 'required|numeric'
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $plan = Service::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $plan->translateOrNew($lang)->title = $data[$lang]['title'];
            $plan->translateOrNew($lang)->description = $data[$lang]['description'];
            $plan->translateOrNew($lang)->salary_type = $data[$lang]['salary_type'];
        }
        // Save Other Tables
        $plan->price = $data['price'];
        $plan->number_of_jobs = $data['number_of_jobs'];

        // Save The Model
        $plan->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $plan = Service::find($id);
        $plan->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.services.index');
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
