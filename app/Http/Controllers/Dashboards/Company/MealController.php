<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Language;
use App\Models\Product;
use App\Models\Meal;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Meal::with(['translations'])->where('company_id',auth('company')->user()->id)->get();
        return view('Company.meals.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $products = Product::query()->where('company_id',auth('company')->user()->id)->get();
        return view('Company.meals.create',compact('departments','products'));
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
            'department_id' => 'required|numeric',
            'price' => 'required|numeric',
            'offer_price' => 'required|numeric',
            'related_products' => 'required',
            'offer_type' => 'required|in:0,1',
        ];

        // if offer is not always
        if ($request->get('offer_type') == 1) {
            $rules['start_offer_at'] = 'required';
            $rules['end_offer_at'] = 'required';
        } else {
            $rules['start_offer_at'] = 'sometimes';
            $rules['end_offer_at'] = 'sometimes';
        }

        $data = $request->validate(array_merge($langs_rules,$rules));

        $meal = new Meal();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $meal->translateOrNew($lang)->title = $data[$lang]['title'];
            $meal->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        // Other Columns
        $meal->department_id = $data['department_id'];
        $meal->price = $data['price'];
        $meal->offer_price = $data['offer_price'];
        $meal->offer_type = $data['offer_type'];
        $meal->start_offer_at = $data['start_offer_at'];
        $meal->end_offer_at = $data['end_offer_at'];
        $meal->company_id = auth('company')->user()->id;

        // Save The Model
        $meal->save();

        // Relation Columns
        if ($request->get('related_products')) {
            $meal->related()->attach($data['related_products']);
        }

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.meals.index');
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
        $element = Meal::find($id);
        $departments = Department::all();
        $products = Product::query()->where('company_id',auth('company')->user()->id)->get();

        return view('Company.meals.edit',compact('element','departments','products'));
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
            'department_id' => 'required|numeric',
            'price' => 'required|numeric',
            'offer_price' => 'required|numeric',
            'related_products' => 'required',
            'offer_type' => 'required|in:0,1',
        ];

        // if offer is not always
        if ($request->get('offer_type') == 1) {
            $rules['start_offer_at'] = 'required';
            $rules['end_offer_at'] = 'required';
        } else {
            $rules['start_offer_at'] = 'sometimes';
            $rules['end_offer_at'] = 'sometimes';
        }

        $data = $request->validate(array_merge($langs_rules,$rules));

        $meal = Meal::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $meal->translateOrNew($lang)->title = $data[$lang]['title'];
            $meal->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        // Other Columns
        $meal->department_id = $data['department_id'];
        $meal->price = $data['price'];
        $meal->offer_price = $data['offer_price'];
        $meal->offer_type = $data['offer_type'];
        $meal->start_offer_at = $data['start_offer_at'];
        $meal->end_offer_at = $data['end_offer_at'];
        $meal->company_id = auth('company')->user()->id;

        // Save The Model
        $meal->save();

        // Relation Columns
        if ($request->get('related_products')) {
            $meal->related()->sync($data['related_products']);
        }

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.meals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $product = Meal::find($id);
        $product->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.meals.index');
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
