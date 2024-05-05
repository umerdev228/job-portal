<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SeekerProfile extends Model
{
   
    protected static function booted()
    {
        static::deleted(function ($user){
            if($user->image){
                Storage::delete($user->image);
            }
        });
    }
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
