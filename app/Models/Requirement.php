<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    public function user()
    {
       return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function inventory()
    {
       return $this->hasOne('App\Models\Inventory', 'id', 'Inventory_id');
    }
}
