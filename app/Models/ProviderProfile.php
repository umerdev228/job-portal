<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProviderProfile extends Model
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

    protected $fillable = ['user_id', 'company_name'];
}
