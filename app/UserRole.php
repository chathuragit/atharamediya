<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserRole extends Model
{
    public static function registered_users_for_role($role, $period = null){
        $result = User::where('role', $role);

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

        return $result->count();
    }
}
