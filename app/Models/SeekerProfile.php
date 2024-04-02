<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'dob',
        'phone',
    ];

    protected $with = ['skills'];
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'seeker_skills', 'user_id', 'skill_id', 'user_id');
    }

}
