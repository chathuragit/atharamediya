<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function assigned_pages(){
        return $this->hasMany('App\ArticlePage', 'article_id');
    }
}
