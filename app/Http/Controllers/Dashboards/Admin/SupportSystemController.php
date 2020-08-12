<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\SupportSystem;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupportSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = SupportSystem::with(['translations'])->get();
        return view('Admin.support-systems.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.support-systems.create');
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
        $rules = ['photo' => 'sometimes'];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $system = new SupportSystem();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $system->translateOrNew($lang)->title = $data[$lang]['title'];
            $system->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        // Save Other Columns
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/support_systems');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;

            $system->photo = $data['photo'];
        }


        // Save The Model
        $system->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.support-systems.index');
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
        $element = SupportSystem::find($id);
        return view('Admin.support-systems.edit',compact('element'));
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
        $rules = [];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $system = SupportSystem::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $system->translateOrNew($lang)->title = $data[$lang]['title'];
            $system->translateOrNew($lang)->description = $data[$lang]['description'];
        }

        // Save Other Columns
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/support_systems');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;

            $system->photo = $data['photo'];
        }

        // Save The Model
        $system->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.support-systems.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $system = SupportSystem::find($id);
        $system->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.support-systems.index');
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
