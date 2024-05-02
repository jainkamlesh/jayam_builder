<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function user()
    {
       return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function dealer()
    {
       return $this->hasOne('App\Models\Dealer', 'id', 'dealer_id');
    }
}
