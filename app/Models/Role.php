<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];


//    Roles
    const ADMIN_ROLE = 'admin';
    const ADMIN_PROVIDER = 'provider';
    const ADMIN_SEEKER = 'seeker';

//    Status
    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVE = 'deactive';

}
