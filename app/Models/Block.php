<?php 

namespace App\Models;

use App\Models\Base\SoftDelete as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Models\Image;

class Block extends Model 
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name', 'description', 'content', 'slug', 'position', 'status', 
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getEventNameAttribute()
    {
    	return $this->name;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function actions()
    {
        if ($this->trashed()) {
            return [
                ['type' => 'restore',   'link' => route('admin.api.block.restore' , $this)],
                ['type' => 'force',     'link' => route('admin.api.block.force'   , $this)],
            ];
        }
     
        return [ 
            // ['type' => 'show',      'link' => route('frontend.block.show'    , $this)],
            ['type' => 'edit',      'link' => route('admin.block.edit'       , $this)],
            ['type' => 'delete',    'link' => route('admin.block.destroy'    , $this)],
        ];
    }
}
