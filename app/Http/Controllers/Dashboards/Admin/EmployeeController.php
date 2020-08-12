<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Employee::all();
        return view('Admin.employees.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.employees.create');
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
            $destinationPath = public_path('/uploads/employees/avatar');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;
        }

        Employee::create($data);
        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.employees.index');
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
        $element = Employee::find($id);
        return view('Admin.employees.edit',compact('element'));
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
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/employees/avatar');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;
        }

        $employee = Employee::find($id);
        $employee->update($data);

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $employee = Employee::find($id);
        $employee->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.employees.index');
    }

    public function addBlockOrRemove($id)
    {
        $employee = Employee::find($id);
        if ($employee->block == 0) {
            $employee->update(['block' => 1]);
        }else {
            $employee->update(['block' => 0]);
        }

        return response()->json(['data' => $employee->block,'message' => '','status' => true]);
    }
}
