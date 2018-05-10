<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Category extends Model
{
    use Sluggable;

    public static function assigned_parent_category($parent_category){
        return Category::where('id', $parent_category)->first();
//        return Category::where('parent_category_id', $parent_category)->where('id', '!=', 1)->first();
    }

    public static function assigned_advertisments_for_category($category, $period = null, $user = null){
        $Category = Category::find($category);
        if(is_object($Category) && ($Category->parent_category_id != 0)){
            $result = Advertisment::where('sub_category_id', $category);
        }
        else{
            $result = Advertisment::where('category_id', $category);
        }

        if($period != null){
            switch ($period){
                case 'Daily':
                    $result->where('created_at', '>=', Carbon::today()->toDateString());
                    break;

                case 'Monthly':
                    $result->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString());
                    break;

                case 'Annually':
                    $result->where('created_at', '>=', Carbon::now()->subDays(365)->toDateTimeString());
                    break;

                default:
                    break;
            }

        }

        if($user != 0){
            $result->where('user_id' , $user);
        }

        return $result->count();
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

    public static function AttributeByID($id){
        return Attribute::where('id', $id)->first();
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }
}
