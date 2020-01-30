<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    protected $primaryKey = 'companyId';

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, ( 'companyId'));
    }
}
