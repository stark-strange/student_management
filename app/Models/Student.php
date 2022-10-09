<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'age', 'gender', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class, 'teacher_id','id');
    }
}
