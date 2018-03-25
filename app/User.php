<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function UsersByType($role, $per_page, $search = null){
        $result = User::where('role', $role);

        if($search != null){
            $result->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return $result->orderBy('id','DESC')->paginate($per_page);
    }

    public function assigned_individual(){
        return $this->hasOne('App\Individual','user_id');
    }

    public function assigned_member(){
        return $this->hasOne('App\Member','user_id');
    }
}
