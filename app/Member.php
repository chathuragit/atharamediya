<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Member extends Model
{
    use Sluggable;

    protected $fillable = ['user_id', 'contact_number', 'contact_email', 'is_active', 'package_id', 'expier_at'];

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

    public static function page_articles($member, $section, $count = null, $type = 4){
        $query = DB::table('member_articles')
            ->where('type', $type)
            ->where('is_active', true)
            ->where('show_in', $section)
            ->where('member_id', $member)
            ->orderBy('id', 'desc');

        if($count == 1){
            $query = $query->first();
        }
        else{
            $query = $query->get();
        }


        return $query;
    }
}
