<?php 

namespace App\Models;

use App\Models\Base\Base as Model;

class Setting extends Model 
{
    protected $fillable = [
        'key', 'group', 'field', 'display', 'value', 
    ];

    public function getShowButtonAttribute()
    {
        return null;
    }

    public function getDestroyButtonAttribute()
    {
        return null;
    }
}
