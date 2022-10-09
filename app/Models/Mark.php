<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = ['maths', 'science', 'history', 'term_id', 'student_id'];

    public function term()
    {
        return $this->belongsTo(\App\Models\Term::class, 'term_id','id');
    }

    public function student()
    {
        return $this->hasOne(\App\Models\Student::class, 'id', 'student_id');
    }
}
