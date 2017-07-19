<?php 

namespace App\Models;

use App\Models\Base\Base as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Tag extends Model 
{
    use Sluggable, SluggableScopeHelpers;
  
    protected $fillable = [
        'slug', 'parent_id', 'name', 'description', 'type', 'image'
    ];
    
    protected $casts = [
        'type' => 'integer'
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

    public function parent()
    {
        return $this->belongsTo(Tag::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Tag::class, 'id', 'parent_id');
    }

    public function getEventNameAttribute()
    {
        return $this->name;
    }

    public function actions()
    {
        return [ 
            ['type' => 'show',      'link' => route('frontend.page.node.show',  $this)],
            ['type' => 'edit',      'link' => route('admin.tag.edit'  ,   [$this->getTypeRouteKey(), $this])],
            ['type' => 'delete',    'link' => route('admin.tag.destroy' , [$this->getTypeRouteKey(), $this]), 'data-redirect' => route('admin.page.deleted')],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function getTypeRouteKey()
    {
        foreach (config('tag.type') as $t => $type) {
            if($type['key'] == $this->type){
                return $type['route'];
            }
        }
        return null;
    }

}

