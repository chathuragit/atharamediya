<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public static function FilterAttributes($per_page, $search = null){
        $result = Attribute::orderBy('id','DESC');

        if($search != null){
            $result->where(function ($query) use ($search) {
                $query->where('attribute_name', 'like', '%' . $search . '%');
            });
        }

        return $result->paginate($per_page);
    }
}
