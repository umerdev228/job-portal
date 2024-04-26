<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
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

}
