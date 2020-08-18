<?php
namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Admin::all();
        if (im('admin')->hasPermissionTo('read_admins')) {
            return view('Admin.admins.index',compact('elements'));
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
        $crud = ['create','read','update','delete'];
        $models = [
            'companies','plans','employees',
            'support-systems','departments',
            'blacklist','skills','agreements',
            'contact-us','settings','languages',
            'admins'
        ];
        if (im('admin')->hasPermissionTo('create_admins')) {
            return view('Admin.admins.create',compact('crud','models'));
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
            'permissions' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        $admin = Admin::create($data);

        $admin->syncPermissions($data['permissions']);

        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.admins.index');
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
        $crud = ['create','read','update','delete'];
        $models = [
            'companies','plans','employees',
            'support-systems','departments',
            'blacklist','skills','agreements',
            'contact-us','settings','languages',
            'admins'
        ];
        $element = Admin::find($id);
        if (im('admin')->hasPermissionTo('update_admins')) {
            return view('Admin.admins.edit',compact('element','crud','models'));
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
            'email' => 'required|unique:admins,email,'.$id,
            'password' => 'sometimes',
            'permissions' => 'required'
        ]);

        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }

        $admin = Admin::find($id);
        $admin->update($data);
        $admin->syncPermissions($data['permissions']);

        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $company = Admin::find($id);
        $company->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.admins.index');
    }
}
