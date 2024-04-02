<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'experience',
        'description',
        'image',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVE = 'deactive';

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id', 'id');
    }

}
