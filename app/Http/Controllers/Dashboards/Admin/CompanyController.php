<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Company::all();
        if (im('admin')->hasPermissionTo('read_companies')) {
            return view('Admin.companies.index',compact('elements'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (im('admin')->hasPermissionTo('create_companies')) {
            return view('Admin.companies.create');
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'photo' => 'sometimes|mimes:jpeg,jpg,png'
        ]);

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/companies/avatar');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;
        }

        Company::create($data);
        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.companies.index');
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
        $element = Company::find($id);
        if (im('admin')->hasPermissionTo('update_companies')) {
            return view('Admin.companies.edit',compact('element'));
        } else {
            abort(403);
        }
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
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'photo' => 'sometimes|mimes:jpeg,jpg,png'
        ]);

        if ($request->file('photo')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/companies/avatar');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;
        }

        $company = Company::find($id);
        $company->update($data);

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $company = Company::find($id);
        $company->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.companies.index');
    }

    public function addBlockOrRemove($id)
    {
        $company = Company::find($id);
        if ($company->block == 0) {
            $company->update(['block' => 1]);
        }else {
            $company->update(['block' => 0]);
        }

        return response()->json(['data' => $company->block,'message' => '','status' => true]);
    }
}
