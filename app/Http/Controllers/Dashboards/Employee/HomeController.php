<?php
namespace App\Http\Controllers\Dashboards\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Language;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function home()
    {
        return view('Employee.home');
    }

    public function login()
    {
        if (!auth('employee')->check()) {
            return view('Employee.login');
        }else{
            return redirect()->route('employee.home');
        }
    }

    public function login_post(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');
        $employeeModel = Employee::where(['email' => $email])->first();
        if ($employeeModel && $employeeModel->block == 1) {
            Session::flash('error', 'Your Account is Blocked, Contact Us');
            return back();
        } else {
            $employee = auth('employee')->attempt(['email' => $email,'password' => $password],$remember);
            if ($employee) {
                Session::flash('login-success', 'Welcome Back');
                return redirect()->route('employee.home');
            } else {
                Session::flash('error', 'Invalid Email or Password');
                return back();
            }
        }

    }

    public function logout()
    {
        auth('employee')->logout();
        Session::flash('success', 'You Are Sign Out Successfully');
        return redirect()->route('employee.login');
    }

    public function profile()
    {
        $languages = Language::all();
        $skills = Skill::all();
        return view('Employee.profile',compact('languages','skills'));
    }

    public function profile_post(Request $request)
    {
        $data = $request->validate([
            'name' => 'sometimes|max:30',
            'email' => 'sometimes|unique:companies,email,'.auth('employee')->user()->id,
            'photo' => 'sometimes|mimes:jpeg,jpg,png',
            'password' => 'sometimes|min:6|confirmed',
            'bio' => 'sometimes',
            'languages' => 'sometimes',
            'country' => 'sometimes',
            'work_from' => 'sometimes',
            'work_to' => 'sometimes',
            'work_days_in_week' => 'sometimes',
            'skills' => 'sometimes',
        ]);

        $data = array_filter($data);
        if (array_key_exists('photo',$data)) {
            if ($request->file('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/employees/avatar');
                $image->move($destinationPath, $name);
                $data['photo'] = $name;
            }
        }
        if (array_key_exists('password',$data)) {
            $data['password'] = bcrypt($data['password']);
        }

        $employee = Employee::find(auth('employee')->user()->id);
        $employee->update($data);

        // Relation Columns
        if ($request->get('skills')) {
            $employee->skills()->sync($data['skills']);
        }

        Session::flash('success', 'Profile Updated Successfully');
        return redirect()->back();
    }

    public function changeLang($lang)
    {
        if (session()->has('employee-lang')) {
            session()->remove('employee-lang');
            session()->put('employee-lang',$lang);
        }else{
            session()->put('employee-lang',$lang);
        }

        return redirect()->back();
    }
}
