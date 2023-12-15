<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends BaseModel
{
    use HasFactory;

    protected $fillable = ['student_id', 'science', 'maths', 'english', 'gujarati', 'hindi', 'total_marks', 'percentage', 'percentile', 'result', 'created_by', 'updated_by'];
}

