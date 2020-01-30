<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role_User extends Model
{
    public $timestamps = false;
    protected $fillable = ['role_id', 'user_id'];

    public $table = "role_user";
      public function users()
      {
        return $this->belongsToMany(User::class);
      }
}
