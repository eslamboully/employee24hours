<?php
namespace App\Http\Controllers\Dashboards\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function home()
    {
        return view('Company.home');
    }

    public function login()
    {
        if (!auth('company')->check()) {
            return view('Company.login');
        }else{
            return redirect()->route('company.home');
        }
    }

    public function login_post(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');
        $companyModel = Company::where(['email' => $email])->first();
        if ($companyModel && $companyModel->block == 1) {
            Session::flash('error', 'Your Account is Blocked, Contact Us');
            return back();
        } else {
            $company = auth('company')->attempt(['email' => $email,'password' => $password],$remember);
            if ($company) {
                Session::flash('login-success', 'Welcome Back');
                return redirect()->route('company.home');
            } else {
                Session::flash('error', 'Invalid Email or Password');
                return back();
            }
        }

    }

    public function logout()
    {
        auth('company')->logout();
        Session::flash('success', 'You Are Sign Out Successfully');
        return redirect()->route('company.login');
    }

    public function profile()
    {
        return view('Company.profile');
    }

    public function profile_post(Request $request)
    {
        $data = $request->validate([
            'name' => 'sometimes|max:30',
            'email' => 'sometimes|unique:companies,email,'.auth('company')->user()->id,
            'photo' => 'sometimes|mimes:jpeg,jpg,png',
            'password' => 'sometimes|min:6|confirmed',
            'bio' => 'sometimes',
            'phone' => 'sometimes',
            'website' => 'sometimes',
            'block' => 'sometimes'
        ]);

        $data = array_filter($data);
        if (array_key_exists('photo',$data)) {
            if ($request->file('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/companies/avatar');
                $image->move($destinationPath, $name);
                $data['photo'] = $name;
            }
        }
        if (array_key_exists('password',$data)) {
            $data['password'] = bcrypt($data['password']);
        }

        $company = Company::find(auth('company')->user()->id);
        $company->update($data);

        Session::flash('success', 'Profile Updated Successfully');
        return redirect()->back();
    }

    public function changeLang($lang)
    {
        if (session()->has('company-lang')) {
            session()->remove('company-lang');
            session()->put('company-lang',$lang);
        }else{
            session()->put('company-lang',$lang);
        }

        return redirect()->back();
    }
}
