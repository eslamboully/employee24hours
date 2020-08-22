<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use SoftDeletes;
    protected $fillable = ['status','description','job_id','employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
