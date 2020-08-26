<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description','status','price','deadline','company_id','job_id','employee_id'];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id','id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
