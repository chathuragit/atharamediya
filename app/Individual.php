<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $fillable = ['user_id', 'contact_number', 'contact_email', 'is_active'];
}
