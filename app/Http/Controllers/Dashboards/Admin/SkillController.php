<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Skill;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Skill::with(['translations'])->get();
        return view('Admin.skills.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.skills.create');
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
        $rules = [];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $skill = new Skill();

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $skill->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Save The Model
        $skill->save();

        Session::flash('success', 'Added Successfully');
        return redirect()->route('admin.skills.index');
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
        $element = Skill::find($id);
        return view('Admin.skills.edit',compact('element'));
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

        $skill = Skill::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach (current_langs() as $lang) {
            $skill->translateOrNew($lang)->title = $data[$lang]['title'];
        }

        // Save The Model
        $skill->save();


        Session::flash('success', 'Edited Successfully');
        return redirect()->route('admin.skills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $skill = Skill::find($id);
        $skill->delete();

        Session::flash('success', 'Deleted Successfully');
        return redirect()->route('admin.skills.index');
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
