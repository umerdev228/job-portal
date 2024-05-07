<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Job extends Model
{

    protected static function booted()
    {
        static::deleting(function ($job) {
            if ($job->image) {
                Storage::delete($job->image);
            }
        });
    }

    use HasFactory;
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';
    const STATUS_CLOSED = 'closed';


    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'experience',
        'description',
        'status',
        'is_feature',
        'image',
    ];

    protected $with = ['skills'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
