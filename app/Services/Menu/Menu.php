<?php

namespace App\Services\Menu;

use App\Models\Menu\Node as Model;
use App\Models\Menu\Menu as MenuModel;
use DB;
use Route;
use Request;
/**
 * Class Menu.
 */
class Menu
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
        return $this->query()->with(['menu', 'related'])->get();
    }

    /**
     * @return collection
     */
    public function cache()
    {
        return cache()->get('menu');
    }

    /**
     * Get specific Menu value with give position
     * @param string $position
     */
    public function positionFromCache($position)
    {
            // $this->cacheSave();
        if(cache()->has('menu') && cache()->get('menu')){
            $menuIds = cache()->get('menu_ids');
            $ids = array_keys(collect(cache()->get('menu_ids'))->filter(function($item) use($position){ return $item == $position; })->toArray());
            $menuList = [];
            $menu = cache()->get('menu')->groupBy('menu_id')->each(function($menu, $key) use(&$menuList) {
                $menuParent = [];
                $menu->groupBy('parent_id')->each(function($node, $id) use(&$menuParent) {
                    $menuParent[($id  == "" ? 'main' : $id)] = $node->sortBy('sort_order');
                });
                $menuList[$key] = collect($menuParent);
            });
            $menuLists = collect($menuList)->filter(function($item, $key) use($ids){
                if(in_array($key, $ids)){ return $item; }
            });
            if(!count($menuLists)){ return null; }
            $menuDisplay = collect();
            foreach ($menuLists as $m => $menus) {
                $menu = $menus->get('main');
                $this->getMenuNodes($menus, $menu);
                $menuDisplay->push($menu);
            }

            return $menuDisplay;
        }else{
            $this->cacheSave();
            return $this->positionFromCache($position);            
        }
    }

    /**
     * Get menu nodes 
     */
    public function getMenuNodes($list, &$menu, $isChild=false)
    {
        $context = $this;
        if(!$menu){ return; }
        return $menu->each(function($item, $key) use($list, $context){
            $nodes = $list->get($item->id);
            if($list->count()){ $context->getMenuNodes($list, $nodes, true); }
            $item->nodes = $nodes;
            return $item;
        });
    }

    /**
     * Cache Menu
     */
    public function cacheSave()
    {
        cache()->forget('menu');
        cache()->forever('menu', $this->all());
        cache()->forget('menu_ids');
        cache()->forever('menu_ids', MenuModel::pluck('position', 'id'));
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Route
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function isActiveRoute($link, $output = "active")
    {
        if (Request::url() == $link->link) return $output;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Routes
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function areActiveRoutes($links, $output = "active")
    {
        foreach ($links as $link)
        {
            if (Request::url() == $link->link) return $output;
        }

    }
}