<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Member extends Model
{
    use Sluggable;

    protected $fillable = ['user_id', 'contact_number', 'contact_email', 'is_active', 'package_id'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public static function memberslist($per_page, $role){
        return DB::table('users')
            ->join('members', function ($join) {
                $join->on('members.user_id', '=', 'users.id');
            })
            ->where('users.role', $role)
            ->where('users.is_active', true)
            ->select('members.*')
            ->paginate($per_page);
    }
}
