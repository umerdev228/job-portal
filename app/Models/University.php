<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class University extends Model

{

    use HasFactory;
    protected $fillable = ['title','country_id','city_id'];

    public function Country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
