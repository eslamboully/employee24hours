<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $fillable = ['price','is_received','employee_id','job_id','contract_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id','id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class,'contract_id','id');
    }
}
