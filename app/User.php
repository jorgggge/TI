<?php

namespace App;

use App\Role;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'username','firstName','lastName', 'email', 'password', 'companyId','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function giveMeRole(User $user)
    {
        return $user->roles()->where('name')->first();
    }
    public static function giveMeCompany(User $user)
    {
        return $user->companyId;
    }
    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'user_areas', 'userId','areaId');
    }
    
    public function evidences()
    {
        return $this->hasMany(Evidences::class,'userId');
    }

     /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    static function CountEvidences($userId,$testId)
    {
        return $attributes = DB::table('attributes')
            ->join('evidences','evidences.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level_attribute as cma','cma.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level as cm','cma.conceptMLId','cm.conceptMLId')
            ->join('concepts','cm.conceptId','concepts.conceptId')
            ->join('test_concept','concepts.conceptId','test_concept.conceptId')
            ->join('test_user','test_concept.testId','test_user.testId')
            ->where([
            	'test_user.userId' => $userId,
            	'test_user.testId' => $testId
            ])->count();
    }

    static function CountEvidencesRegular($userId,$testId,$conceptId)
    {
        return $attributes = DB::table('attributes')
            ->join('evidences','evidences.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level_attribute as cma','cma.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level as cm','cma.conceptMLId','cm.conceptMLId')
            ->join('concepts','cm.conceptId','concepts.conceptId')
            ->join('test_concept','concepts.conceptId','test_concept.conceptId')
            ->join('test_user','test_concept.testId','test_user.testId')
            ->where([
                'test_user.userId' => $userId,
                'test_user.testId' => $testId,
                'test_concept.conceptId' => $conceptId
            ])->count();
    }
}
