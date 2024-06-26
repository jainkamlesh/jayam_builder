<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;

    public function site()
    {
       return $this->hasOne('App\Models\Site', 'id', 'site_id');
    }
}
