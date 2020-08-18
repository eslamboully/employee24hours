<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Language;
use App\Models\ServiceCategory;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = ServiceCategory::with(['translations'])->where('company_id',auth('company')->user()->id)->get();
        return view('Company.service-categories.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.service-categories.create');
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

        ];

        $data = $request->validate(array_merge($langs_rules,$rules));

        $question = new ServiceCategory();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $question->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Other Columns
        $question->company_id = auth('company')->user()->id;

        // Save The Model
        $question->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.service-categories.index');
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
        $element = ServiceCategory::find($id);
        return view('Company.service-categories.edit',compact('element'));
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

        ];

        $data = $request->validate(array_merge($langs_rules,$rules));

        $question = ServiceCategory::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $question->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Other Columns
        $question->company_id = auth('company')->user()->id;

        // Save The Model
        $question->save();

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.service-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $question = ServiceCategory::find($id);
        $question->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.service-categories.index');
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
