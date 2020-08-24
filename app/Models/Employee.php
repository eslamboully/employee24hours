<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Employee extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo', 'bio', 'languages', 'country', 'block', 'work_from', 'work_to','work_days_in_week'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_employee', 'employee_id', 'skill_id');
    }

    public function getSkillsId()
    {
        $skills = DB::table('skill_employee')->where('employee_id',$this->id)->pluck('skill_id')->toArray();
        return $skills;
    }

    public function bids()
    {
        return $this->hasMany(Bid::class,'employee_id','id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class,'employee_id','id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_employee','company_id','employee_id')
            ->select(['started_at', 'salary_appointment_at','salary']);;
    }

    public function pivotCompanyColumns($company_id)
    {
        $company_employee = DB::table('company_employee')->where(['employee_id' => $this->id,'company_id' =>$company_id])->first();
        return $company_employee;
    }

    public function languages()
    {
        $languages = json_decode($this->languages,JSON_UNESCAPED_UNICODE);
        if ($languages){
            return $languages;
        }
        return [];
    }
}
