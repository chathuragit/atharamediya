<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

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
                    }else{
                        $query->where('location', 'like', '%' . $search->location . '%');
                    }
                }
            });
        }

        $result->where('is_active', true);

        if($search != null){
            if($search->sort_by_price != null){
                switch ($search->sort_by_price){
                    case 'lowast':
                        $result->orderBy('price', 'ASC');
                        break;

                    case 'highest':
                        $result->orderBy('price', 'DESC');
                        break;
                }

            }

            if(($search->sort_by_time != null) || ($search->sort_by_time != "")){
                switch ($search->sort_by_time){
                    case 'oldest':
                        $result->orderBy('created_at', 'ASC');
                        break;

                    case 'latest':
                        $result->orderBy('created_at', 'DESC');
                        break;
                }
            }

            if($search->sort_by_advertisertype != null){
                switch ($search->sort_by_advertisertype){
                    case 'oldest':
                        $result->orderBy('created_at', 'ASC');
                        break;

                    case 'latest':
                        $result->orderBy('created_at', 'DESC');
                        break;
                }
            }
        }else{
            $result->orderBy('id','DESC');
        }

        return $result->paginate($per_page);
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

    public static function advertisment_attributes_and_values($id){
        return DB::table('advertisments')
            ->join('advertisment_attributes', function ($join) {
                $join->on('advertisment_attributes.advertisment_id', '=', 'advertisments.id');
            })
            ->join('attributes', function ($join) {
                $join->on('advertisment_attributes.attribute_id', '=', 'attributes.id');
            })->where('advertisments.id', $id)
            ->select('attributes.attribute_name','advertisment_attributes.attribute_value')
            ->get();
    }

    public static function advertisment_user($id){
        return DB::table('advertisments')
            ->join('users', function ($join) {
                $join->on('advertisments.user_id', '=', 'users.id');
            })
            ->where('advertisments.id', $id)
            ->select('users.*')
            ->first();
    }

    public static function is_serial($string) {
        return (@unserialize($string) !== false);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function stingImage($image_name)
    {
        $path = $image_name;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
