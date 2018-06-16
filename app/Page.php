<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static function page_articles($page, $section, $count = null){
        $query = DB::table('articles')
            ->join('article_pages', function ($join) {
                $join->on('article_pages.article_id', '=', 'articles.id');
            })
            ->where('article_pages.page_id', $page)
            ->where('articles.show_in', $section)
            ->where('articles.is_active', true)
            ->orderBy('id', 'desc')
            ->select('articles.*');

        if($count == 1){
            $query = $query->first();
        }
        else{
            $query = $query->get();
        }


         return $query;
    }
}
