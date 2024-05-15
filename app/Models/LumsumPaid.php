<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LumsumPaid extends Model
{
    use HasFactory;

    public function dealer()
    {
       return $this->hasOne('App\Models\Dealer', 'id', 'dealer_id');
    }
}
