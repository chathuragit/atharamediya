<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    public static function log_filter($per_page, $search = null){
        $result = DB::table('logs')->orderBy('logs.id','DESC');

        if($search != null){
            //$result->where('logs.log', 'like', '%' . $search . '%');
            $result->join('users', function ($join) use ($search) {
                $join->on('users.id', '=', 'logs.user_id')->where(function ($query) use ($search) {
                    $query->where('users.name', 'like', '%' . $search . '%')
                        ->orWhere('logs.log', 'like', '%' . $search . '%');
                });
            });
        }else{
            $result->join('users', function ($join){
                $join->on('users.id', '=', 'logs.user_id');
            });
        }

        return $result->select('users.name', 'logs.*')->paginate($per_page);
    }

}

