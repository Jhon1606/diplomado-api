<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'document',
        'name',
        'last_name',
        'email',
        'contract_type', // 1 = 40, 2 = 20
        'laboral_hours'
    ];

    protected $hidden = ['pivot'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, Assignment::class);
    }

    public function assigment()
    {
        return $this->hasOne(Assignment::class);
    }

}
