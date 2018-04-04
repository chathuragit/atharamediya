<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberArticle extends Model
{
    public function assigned_member(){
        return $this->belongsTo('App\Member', 'member_id');
    }
}
