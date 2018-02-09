<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public static function assigned_parent_category($parent_category){
        return Category::where('parent_category_id', $parent_category)->where('id', '!=', 1)->first();
    }

    public static function FilterCategory($per_page, $search = null){
        $result = Category::orderBy('id','DESC');

        if($search != null){
            $result->where(function ($query) use ($search) {
                $query->where('category_name', 'like', '%' . $search . '%');
            });
        }

        return $result->paginate($per_page);
    }

    public static function CategoryAttributeByID($category, $attribute){
        return DB::table('category_attributes')->where('category_id', $category)->where('attribute_id', $attribute)->first();
    }


    public function assigned_attributes(){
        return $this->hasMany('App\CategoryAttribute', 'category_id');
    }
}
