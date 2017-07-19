<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Node extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'menu_id', 'parent_id', 'related_id', 'related_type', 'type', 'custom-id',
        'slug', 'url', 'title', 'icon_font', 'target', 'css_class', 'sort_order'
    ];

    protected $cast = ['sort_order' => 'integer'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getEventNameAttribute()
    {
        return $this->name;
    }

    public function getNameAttribute()
    {
        return $this->title ? $this->title : 'Menu # ' . $this->id;
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(Node::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Node::class, 'parent_id');
    }

    public function isCustom()
    {
        return $this->type == "custom-link";
    }

    public function isCustomType()
    {
        return in_array($this->type, config('menu'));
    }

    public function related()
    {
        return $this->morphTo('related');
    }

    public function getLinkAttribute()
    {
        if($this->isCustom()){ return $this->url; }
        $type = config('menu.menus')[$this->type];
        return route($type['url'], $this->related);
    }
}
