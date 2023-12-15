<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends BaseModel
{
    use HasFactory;

    protected $fillable=['student_code','name','email','gender','parent_name','standard','city','state','pincode','filename','created_by','updated_by'];

    /* relation of table result with student */
    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
