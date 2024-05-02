<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingTwo extends Model
{
    use HasFactory;

    public function inventory()
    {
       return $this->hasOne('App\Models\Inventory', 'id', 'inventory');
    }

    public function site()
    {
       return $this->hasOne('App\Models\Site', 'id', 'site_id');
    }

}
