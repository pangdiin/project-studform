<?php 

namespace App\Models;

use App\Models\Base\Base as Model;

use App\Models\Image;

class Slide extends Model 
{
    protected $fillable = [
        'title', 'description', 'path', 'order', 'link'
    ];

    public function getEventNameAttribute()
    {
        return $this->name;
    }

    public function getNameAttribute()
    {
        return $this->title ? $this->title : 'Slide # ' . $this->id;
    }

    public function getImageAttribute()
    {
        return $this->path ? asset($this->path) : asset('images/no-image.jpg');
    }

    public function getShowButtonAttribute()
    {
    	return null;
    }

    public function getLinkUpdateAttribute()
    {
        return route('admin.slide.edit', $this);
    }

    public function getLinkDeleteAttribute()
    {
        return route('admin.slide.destroy', $this);
    }

}

