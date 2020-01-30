<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Area extends Model
{
    public $timestamps = false;
    public $table = "user_areas";
    protected $fillable = [
        'name','companyId'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
