<?php

namespace App\Models\Menu;

use App\Models\Base\Base as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Menu extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name', 'slug', 'position', 'depth'
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

    public function getShowButtonAttribute()
    {
    	return null;
    }

    public function getLinkUpdateAttribute()
    {
        return route('admin.menu.edit', $this);
    }

    public function getDestroyButtonAttribute()
    {
        return config('menu.can_delete') ? '<a name="btn_delete" href="'. $this->link_delete .'" data-reload="' . ($this->destory_reload ? $this->destroy_reload : 'reload') . '" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ' : null;
    }

    public function getLinkDeleteAttribute()
    {
        return config('menu.can_delete') ? route('admin.menu.destroy', $this) : null;
    }

    public function nodes()
    {
        return $this->hasMany(Node::class)->orderBy('sort_order', 'ASC');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
