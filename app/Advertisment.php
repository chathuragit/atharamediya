<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Advertisment extends Model
{
    use Sluggable;

    public static function FilterAdvertisment($status = null, $per_page, $search = null){
        $result = Advertisment::where('status', '!=', 5);

        if($status != null){
            $result->where('status', $status);
        }

        if($search != null){
            $result->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        }

        return $result->orderBy('id','DESC')->paginate($per_page);
    }

    public function assigned_category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function assigned_status(){
        return $this->belongsTo('App\AdvertismentStatus', 'status');
    }

    public function advertisment_attributes(){
        return $this->hasMany('App\AdvertismentAttribute', 'advertisment_id');
    }

    public function advertisment_media(){
        return $this->hasMany('App\AdvertismentMedia', 'advertisment_id');
    }

    public static function advertisment_attribute_byid($id){
        return Attribute::where('id', $id)->first();
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
