<?php

namespace App\Services\Setting;

use App\Models\Setting as Model;

/**
 * Class Setting.
 */
class Setting
{
	const MODEL = Model::class;

	/**
     * Get specific setting value with give key
     * @param string $key
     */
    public function key($key)
    {
        return $this->query()->where('key', $key)->select(['value'])->firstOrFail()->value;
    }

    /**
     * Get specific setting value with give key from cached Settings
     * @param string $key
     */
    public function keyFromCache($key, $groupKey)
    {
        $group = config('setting')[$groupKey];
        if($group['cache'] && cache()->has($groupKey)){ return cache()->get($groupKey)->where('key', $key)->first()->value; }
        return $this->key($key);
    }

    /**
     * Get specific setting value with give key
     * @param string $key
     */
    public function group($group)
    {
        return $this->query()->where('type', $group)->select(['value', 'key'])->get();
    }


    /**
     * Get specific setting value with give key
     * @param string $key
     */
    public function keys($keys=[])
    {
        return $this->query()->whereIn('key', $keys)->select(['value', 'key'])->get();
    }
    
    /**
     * Get specific setting value with give key
     * @param string $key
     */
    public function groups($groups=[])
    {
        return $this->query()->whereIn('type', $groups)->select(['value', 'key'])->get();
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }

    /**
     * Cache setting
     */
    public function cacheSettings()
    {
        foreach (config('setting') as $g => $group) {
            if($group['cache']){
                if(!cache()->has($g)){ cache()->forget($g); cache()->forever($g, $this->group($g)); }
            }
        }
    }

    /**
     * Cache setting
     */
    public function filterFromGroup($group, $key)
    {
        return $group->filter(function($item) use($key) { return $item->key == $key; })->first()->value;
    }
}