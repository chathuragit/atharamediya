<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_active', 'confirmed', 'confirmation_code'
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

    public function assigned_role(){
        return $this->belongsTo('App\UserRole','role');
    }

    public function assigned_individual(){
        return $this->hasOne('App\Individual','user_id');
    }

    public function assigned_member(){
        return $this->hasOne('App\Member','user_id');
    }

    public static function approved_advertisments_by_administrator($administrator, $period = null, $category = null){
        $result = Advertisment::where('approved_by', $administrator);

        if($period != null){
            switch ($period){
                case 'Daily':
                    $result->where('created_at', '>=', Carbon::today()->toDateString());
                    break;

                case 'Monthly':
                    $result->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString());
                    break;

                case 'Annually':
                    $result->where('created_at', '>=', Carbon::now()->subDays(365)->toDateTimeString());
                    break;

                default:
                    break;
            }

        }

        if($category != 0){

            $Category = Category::find($category);
            if(is_object($Category) && ($Category->parent_category_id != 0)){
                $result->where('sub_category_id', $category);
            }
            else{
                $result->where('category_id', $category);
            }
        }

        return $result->count();
    }


    public static function assigned_web_space_banners($administrator = null, $period = null, $webspaceuser){
        $result = Banner::where('user_id', $webspaceuser);

        if($period != null){
            switch ($period){
                case 'Daily':
                    $result->where('created_at', '>=', Carbon::today()->toDateString());
                    break;

                case 'Monthly':
                    $result->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString());
                    break;

                case 'Annually':
                    $result->where('created_at', '>=', Carbon::now()->subDays(365)->toDateTimeString());
                    break;

                default:
                    break;
            }

        }

        if($administrator != 0){
            $result->where('approved_by', $administrator);
        }

        return $result->count();
    }
}
