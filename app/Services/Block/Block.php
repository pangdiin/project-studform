<?php

namespace App\Services\Block;

use App\Models\Block as Model;
use DB;
/**
 * Class Block.
 */
class Block
{
    const MODEL = Model::class;

	/**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }

    /**
     * @return collection
     */
    public function all()
    {
        return $this->query()->where('status', 'active')->get();
    }

    /**
     * @return collection
     */
    public function cache()
    {
        return cache()->get('blocks');
    }

    /**
     * Get specific Menu value with give position
     * @param string $position
     */
    public function positionFromCache($position)
    {
            // $this->cacheSave();
        if(cache()->has('blocks') && cache()->get('blocks')){
            $blocks = cache()->get('blocks');
            return $blocks->filter(function($block) use($position) {
                return $block->position == $position;
            });
        }else{
            $this->cacheSave();
            return $this->positionFromCache($position);            
        }
    }

    /**
     * Cache Menu
     */
    public function cacheSave()
    {
        cache()->forget('blocks');
        cache()->forever('blocks', $this->all());
    }
}