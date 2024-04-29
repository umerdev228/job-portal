<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];

    const STATUS_ACTIVE = '1';
    const STATUS_DEACTIVE = '0';

}
