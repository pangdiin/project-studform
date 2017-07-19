<?php 

namespace App\Models;

use App\Models\Base\Base as Model;

class Image extends Model 
{
  
    protected $fillable = [
        'name', 'path', 'relation_id', 'relation_type'
    ];

    public function relation()
    {
        return $this->morphTo();
    }

}

