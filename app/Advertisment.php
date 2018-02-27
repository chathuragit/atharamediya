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
                $query->where('title', 'like', '%' . $search->search . '%');

                if($search->category != null){
                    $category = Category::where('slug', $search->category)->first();
                    if($category != null){
                        $query->where('category_id', $category->id);
                    }
                }

                if($search->location != null){
                    $District = District::where('district', $search->location)->first();
                    if($District != null){
                        $query->where('location_id', $District->id);
                    }
                }
            });
        }

        $result->where('is_active', true);

        return $result->orderBy('id','DESC')->paginate($per_page);
    }

    public static function similar_ads($Advertisement, $perpage){
        $result = Advertisment::where('category_id', $Advertisement->category_id);
        $result->where('status', 2);
        $result->where('id', '!=', $Advertisement->id);
        $result->where('is_active', true);

        return $result->inRandomOrder()->limit($perpage)->get();
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

    public function advertisment_location(){
        return $this->belongsTo('App\District', 'location_id');
    }

    public function advertisment_media(){
        return $this->hasMany('App\AdvertismentMedia', 'advertisment_id');
    }

    public static function advertisment_default_image($advertisment_id){
        return AdvertismentMedia::where('advertisment_id', $advertisment_id)->where('default_pic', true)->first();
    }

    public static function advertisment_first_image($advertisment_id){
        return AdvertismentMedia::where('advertisment_id', $advertisment_id)->orderBy('id', 'ASC')->first();
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
