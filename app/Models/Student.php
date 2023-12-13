<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends BaseModel
{
    use HasFactory;

    protected $fillable=['student_code','name','email','gender','parent_name','standard','city','state','pincode','created_by','updated_by'];
}
