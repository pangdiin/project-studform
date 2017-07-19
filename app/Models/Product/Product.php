<?php

namespace App\Models\Product;

use App\Models\Base\SoftDelete as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Models\Gallery\Gallery;
use App\Models\Tag;

class Product extends Model
{
    use Sluggable;

    protected $fillable = [
    	'name',
        'brand_id',
        'description',
        'content',
        'specification',
        'image',
        'thumbnail',
        'slug',
    ];

    protected $with = ['brand'];

    public function brand()
    {
        return $this->belongsTo(Tag::class, 'brand_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function galleries()
    {
        return $this->morphMany('App\Models\Gallery\Gallery', 'imageable');
    }

    public function brochures()
    {
        return $this->hasMany(Brochure::class);
    }
    
    public function getImagePathAttribute()
    {
        return file_exists($this->image) ? asset($this->image) : asset( 'images/product/' . $this->image);
    }
    
    public function getThumbnailPathAttribute()
    {
        return file_exists($this->thumbnail) ? asset($this->thumbnail) : asset( 'images/product/' . $this->thumbnail);
    }

    public function getEventNameAttribute()
    {
        return $this->name;
    }

    // Type , Link, Icon, Tooltip, Label

    public function actions()
    {
        if ($this->trashed()) {
            return [
                ['type' => 'restore',   'link' => route('admin.api.product.restore' , $this), 'data-redirect' => route('admin.page.index')],
                ['type' => 'force',     'link' => route('admin.api.product.force'   , $this), 'data-redirect' => route('admin.page.index')],
            ];
        }

        return [ 
            ['type' => 'show',      'link' => route('frontend.product.show'    , $this)],
            ['type' => 'edit',      'link' => route('admin.product.edit'    , $this)],
            ['type' => 'delete',    'link' => route('admin.product.destroy' , $this)],

            ['type' => 'gallery',    'link' => route('admin.gallery.product.index' , $this), 'icon' => 'fa fa-image', 'label' => 'Gallery', 'name' => 'btn_gallery'],
            ['type' => 'brochure',    'link' => route('admin.product.brochure.index' , $this), 'icon' => 'fa fa-upload', 'label' => 'Brochure', 'name' => 'btn_brochure'],

        ];
    }

}
