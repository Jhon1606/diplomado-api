<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'teacher_id'
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
