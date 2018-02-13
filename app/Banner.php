<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function FilterBannerAdvertisment($status = null, $per_page, $search = null){
        $result = Banner::where('status', '!=', 5);

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
}
