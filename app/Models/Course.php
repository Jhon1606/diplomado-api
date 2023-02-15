<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hours_max'
    ];

    protected $hidden = ['pivot'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, Assignment::class);
    }

    public function assigment()
    {
        return $this->hasOne(Assignment::class);
    }
}
