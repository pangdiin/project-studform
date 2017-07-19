<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
// use Imagick;


class Brochure extends Model
{
    protected $table = "brochures";

    protected $fillable = ['path', 'image'];

	public $timestamps = false;

    protected $with = ['product'];

    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    public function getRawPathAttribute()
    {
        return 'images/product/brochure/' .$this->path;
    }

    public function getFullPathAttribute()
    {
    	return asset('images/product/brochure/' .$this->path); 
    }

    public function thumbnail()
    {
        return asset('images/product/brochure/thumbnail/' .$this->image); 
        
    }
}
