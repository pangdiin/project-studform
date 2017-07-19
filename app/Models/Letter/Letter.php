<?php

namespace App\Models\Letter;

use App\Models\Base\SoftDelete as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Letter extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name', 'slug', 'content'
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
                ['type' => 'restore',   'link' => route('admin.api.letter.restore' , $this)],
                ['type' => 'force',     'link' => route('admin.api.letter.force'   , $this)],
            ];
        }
        return [ 
            // ['type' => 'show',      'link' => route('frontend.letter.show'    , $this)],
            ['type' => 'edit',      'link' => route('admin.letter.edit'       , $this)],
            ['type' => 'delete',    'link' => route('admin.letter.destroy'    , $this)],
        ];
    }
}
