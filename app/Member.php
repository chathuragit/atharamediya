<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Member extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public static function memberslist($per_page){
        return DB::table('users')
            ->join('members', function ($join) {
                $join->on('members.user_id', '=', 'users.id');
            })
            ->where('users.role', 4)
            ->where('users.is_active', true)
            ->select('members.*')
            ->paginate($per_page);
    }
}
