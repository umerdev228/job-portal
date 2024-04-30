<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title','is_feature', 'status'];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
   

}
