<?php 

namespace App\Models\Project;

use App\Models\Base\SoftDelete as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Models\Image;

class Project extends Model 
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name', 'slug', 'content', 'description', 
        'image','status', 'thumbnail'
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

    public function galleries()
    {
        return $this->morphMany('App\Models\Gallery\Gallery', 'imageable');
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
                ['type' => 'restore',   'link' => route('admin.api.project.restore' , $this)],
                ['type' => 'force',     'link' => route('admin.api.project.force'   , $this)],
            ];
        }
        if($this->priority){
            return [ 
                ['type' => 'show',      'link' => route('frontend.project.show'    , $this)],
                ['type' => 'edit',      'link' => route('admin.project.edit'       , $this)],
            ];
        }

        return [ 
            ['type' => 'show',      'link' => route('frontend.project.show'    , $this)],
            ['type' => 'edit',      'link' => route('admin.project.edit'       , $this)],
            ['type' => 'delete',    'link' => route('admin.project.destroy'    , $this)],

            ['type' => 'gallery',    'link' => route('admin.gallery.project.index' , $this), 'icon' => 'fa fa-image', 'label' => 'Gallery', 'name' => 'btn_gallery'],

        ];
    }
}
