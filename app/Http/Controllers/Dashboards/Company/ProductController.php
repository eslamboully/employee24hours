<?php

namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Language;
use App\Models\Product;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Product::with(['translations'])->where('company_id',auth('company')->user()->id)->get();
        return view('Company.products.index',compact('elements'));
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
        return view('Company.products.create',compact('departments','products'));
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
            'photo' => 'sometimes|mimes:jpeg,jpg,png',
            'department_id' => 'required|numeric',
            'status' => 'required|in:cold,hot,not_food',
            'quantity' => 'required|numeric',
            'loyalty_points' => 'required|numeric',
            'price' => 'required',
            'related_products' => 'sometimes',
        ];

        $data = $request->validate(array_merge($langs_rules,$rules));

        $product = new Product();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $product->translateOrNew($lang)->title = $data[$lang]['title'];
            $product->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        // Other Columns
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/products');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;

            $product->photo = $data['photo'];
        }

        $product->department_id = $data['department_id'];
        $product->status = $data['status'];
        $product->quantity = $data['quantity'];
        $product->loyalty_points = $data['loyalty_points'];
        $product->company_id = auth('company')->user()->id;

        // Save The Model
        $product->save();

        // Relation Columns
        if ($request->get('related_products')) {
            $product->related()->attach($data['related_products']);
        }

        Session::flash('success', 'Added Successfully');
        return redirect()->route('company.products.index');
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
        $element = Product::find($id);
        $departments = Department::all();
        $products = Product::query()->where('company_id',auth('company')->user()->id)->get();

        return view('Company.products.edit',compact('element','departments','products'));
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
            'photo' => 'sometimes|mimes:jpeg,jpg,png',
            'department_id' => 'required|numeric',
            'status' => 'required|in:cold,hot,not_food',
            'quantity' => 'required|numeric',
            'loyalty_points' => 'required|numeric',
            'price' => 'required',
            'related_products' => 'sometimes',
        ];

        $data = $request->validate(array_merge($langs_rules,$rules));

        $product = Product::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $product->translateOrNew($lang)->title = $data[$lang]['title'];
            $product->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        // Other Columns
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/products');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;

            $product->photo = $data['photo'];
        }

        $product->department_id = $data['department_id'];
        $product->status = $data['status'];
        $product->quantity = $data['quantity'];
        $product->loyalty_points = $data['loyalty_points'];
        $product->company_id = auth('company')->user()->id;

        // Save The Model
        $product->save();

        // Relation Columns
        if ($request->get('related_products')) {
            $product->related()->sync($data['related_products']);
        }

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('company.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $product = Product::find($id);
        $product->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('company.products.index');
    }

    public function recommended()
    {
        $elements = Product::where('recommended',1)->where('company_id',auth('company')->user()->id)->get();
        return view('company.products.recommended-products',compact('elements'));
    }

    public function blockProductIndex()
    {
        $elements = Product::where('block',1)->where('company_id',auth('company')->user()->id)->get();
        return view('company.products.block-products',compact('elements'));
    }

    public function recommendedDestroy($id)
    {
        $product = Product::find($id);
        if ($product->recommended == 0) {
            $product->update(['recommended' => 1]);
        }else {
            $product->update(['recommended' => 0]);
        }

        return response()->json(['data' => $product->recommended,'message' => '','status' => true]);
    }

    public function blockProduct($id)
    {
        $product = Product::find($id);
        if ($product->block == 0) {
            $product->update(['block' => 1]);
        }else {
            $product->update(['block' => 0]);
        }

        return response()->json(['data' => $product->block,'message' => '','status' => true]);
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
