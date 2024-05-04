<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AdminProfile extends Model
{
    protected static function booted()
    {
        static::deleted(function ($user){
           if($user->image)
           {
            Storage::delete($user->image);
           }
        });
    }
    use HasFactory;
}
