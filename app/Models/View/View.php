<?php 

namespace App\Models\View;

use App\Models\Base\SoftDelete as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Models\Image;
use DB;

class View extends Model 
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name', 'slug', 'content', 'image', 
        'seo', 'description', 'meta',
        'type', 'status', 
        'row_class', 'row_id', 'template', 'item_class', 
        'paginate',
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

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function criterias()
    {
        return $this->hasManyThrough(Criteria::class, Content::class);
    }

    public function actions()
    {
        if ($this->trashed()) {
            return [
                ['type' => 'restore',   'link' => route('admin.api.view.restore' , $this)],
                ['type' => 'force',     'link' => route('admin.api.view.force'   , $this)],
            ];
        }
    
        return [ 
            // ['type' => 'show',      'link' => route('frontend.view.show'    , $this)],
            ['type' => 'edit',      'link' => route('admin.view.edit'       , $this)],
            ['type' => 'delete',    'link' => route('admin.view.destroy'    , $this)],
        ];
    }


    public function getList($page=null)
    {
        $data = collect();
        foreach ($this->contents as $c => $content) {
            $query = app()->make(config('view.content.' . $content->type . '.model'));
            $contentConfig = config('view.content.'.$content->type);



            if(count(config('view.content.'.$content->type. '.where'))){
                foreach (config('view.content.'.$content->type. '.where') as $w => $where) {
                    $query = $query->where($w, $where);
                }
            }

            if(count($content->criterias)){
                foreach ($content->criterias as $cr => $criteria) {
                    if(count(config('view.content.' . $content->type . '.with'))){
                        $query = $query->with(config('view.content.' . $content->type . '.with'));
                    }
                    $comparison = config('view.conditions')[$criteria->comparison];
                    if($comparison == "in"){
                        $query = $query->whereIn( 
                            config('view.content.' . $content->type .'.fields')[$criteria->field],
                            explode(',', $criteria->condition)
                        );  
                    }elseif($comparison == "like"){
                        $query = $query->where( 
                            config('view.content.' . $content->type .'.fields')[$criteria->field], 'like', '%' .
                            $criteria->condition . '%'
                        );  
                    }else{
                        $query = $query->where( 
                            config('view.content.' . $content->type .'.fields')[$criteria->field],
                            $comparison,
                            $criteria->condition
                        );    
                    }
                }
            }
            $data = $data->merge(
                $query->get()->each(function($item) use($contentConfig){
                    if(array_key_exists('path', $contentConfig)){
                        $item->path = $contentConfig['path']['view'];
                        $item->edit = $contentConfig['path']['admin'];
                    }
                })
            );
        }
        return $page ? $data->take($this->paginate) : $data;    
    }

    public function getItem($itemSlug)
    {
        foreach ($this->contents as $c => $content) {
            $query = app()->make(config('view.content.' . $content->type . '.model'));
            if(count(config('view.content.'.$content->type. '.where'))){
                foreach (config('view.content.'.$content->type. '.where') as $w => $where) {
                    $query = $query->where($w, $where);
                }
            }

            if(count($content->criterias)){
                foreach ($content->criterias as $cr => $criteria) {
                    if(count(config('view.content.' . $content->type . '.with'))){
                        $query = $query->with(config('view.content.' . $content->type . '.with'));
                    }
                    $comparison = config('view.conditions')[$criteria->comparison];
                    if($comparison == "in"){
                        $query = $query->whereIn( 
                            config('view.content.' . $content->type .'.fields')[$criteria->field],
                            explode(',', $criteria->condition)
                        );  
                    }elseif($comparison == "like"){
                        $query = $query->where( 
                            config('view.content.' . $content->type .'.fields')[$criteria->field], 'like', '%' .
                            $criteria->condition . '%'
                        );  
                    }else{
                        $query = $query->where( 
                            config('view.content.' . $content->type .'.fields')[$criteria->field],
                            $comparison,
                            $criteria->condition
                        );    
                    }
                }
            }

            if($query->whereSlug($itemSlug)->first()){
                return [
                    'option'=> config('view.content.' . $content->type),
                    'item'  => $query->whereSlug($itemSlug)->first()
                ];
            }
        }
        return null;
    }
}
