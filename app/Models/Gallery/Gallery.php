<?php

namespace App\Models\Gallery;

use App\Models\Base\Base as Model;

class Gallery extends Model
{
	protected $table = "galleries";

    protected $fillable = [
    	'path',
    ];

	public $timestamps = false;
    
    public function imageable()
    {
    	return $this->morphTo();
    }

    public function getFullPathAttribute()
    {
    	return asset($this->path);
    }
}
