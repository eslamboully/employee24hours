<?php
namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ContactUs;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function home()
    {
        return view('Admin.home');
    }

    public function login()
    {
        if (!auth('admin')->check()) {
            return view('Admin.login');
        }else{
            return redirect()->route('admin.home');
        }
    }

    public function login_post(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');
        $admin = auth('admin')->attempt(['email' => $email,'password' => $password],$remember);

        if ($admin) {
            Session::flash('login-success', 'Welcome Back');
            return redirect()->route('admin.home');
        } else {
            Session::flash('error', 'Invalid Email or Password');
            return back();
        }
    }

    public function logout()
    {
        auth('admin')->logout();
        Session::flash('success', 'You Are Sign Out Successfully');
        return redirect()->route('admin.login');
    }

    public function changeLang($lang)
    {
        if (session()->has('admin-lang')) {
            session()->remove('admin-lang');
            session()->put('admin-lang',$lang);
        }else{
            session()->put('admin-lang',$lang);
        }

        return redirect()->back();
    }

    public function blockList()
    {
        $companies = Company::where('block', 1)->get();
        $employees = Employee::where('block', 1)->get();
        return view('Admin.blacklist',compact('companies','employees'));
    }

    public function contactUs()
    {
        $elements = ContactUs::get();
        return view('Admin.contact-us',compact('elements'));
    }
}
