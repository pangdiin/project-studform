<?php 

namespace App\Models;

use App\Models\Base\SoftDelete as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Models\Image;

class Page extends Model 
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name', 'slug', 'content', 'description', 
        'image', 'thumbnail',
        'seo', 'meta', 'priority', 'status'
    ];


    protected $casts = [
    	'priority' 	=> 'integer',
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
                ['type' => 'restore',   'link' => route('admin.api.page.restore' , $this)],
                ['type' => 'force',     'link' => route('admin.api.page.force'   , $this)],
            ];
        }
        if($this->priority > 0){
            return [ 
                ['type' => 'show',      'link' => route('frontend.page.show'    , $this)],
                ['type' => 'edit',      'link' => route('admin.page.edit'       , $this)],
            ];
        }

        return [ 
            ['type' => 'show',      'link' => route('frontend.page.show'    , $this)],
            ['type' => 'edit',      'link' => route('admin.page.edit'       , $this)],
            ['type' => 'delete',    'link' => route('admin.page.destroy'    , $this)],
        ];
    }
}
