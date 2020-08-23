<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['description','job_id','accept','employee_id','refusal_details','again'];

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id','id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
