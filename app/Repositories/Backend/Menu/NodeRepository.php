<?php

namespace App\Repositories\Backend\Menu;

use App\Models\Menu\Node as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository as Repository;


/**
 * Class NodeRepository.
 */
class NodeRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Node
     */
    protected $model;

    /**
     * @var realative Nodes
     */
    protected $allRelatedNodes;

    /**
     * @param RoleRepository $role
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * $messages
     * @param $menuId
     * @param $node
     * @param null $parentId
     */
    public function updateMenuNodes($create, $menu, $node, $order, $parentId = null)
    {
        $related_type = null;
        if( array_get($node, 'type') != "custom-link"){ $related_type = array_get($node, 'type'); }
        $data = [
            'menu_id'       => $menu->id,
            'parent_id'     => $parentId,
            'related_id'    => array_get($node, 'related_id') ?: null,
            'type'          => array_get($node, 'type'),
            'related_type'  => $related_type,
            'title'         => array_get($node, 'title') ? array_get($node, 'title') : array_get($node, 'model_title'),
            'icon_font'     => array_get($node, 'icon_font'),
            'css_class'     => array_get($node, 'css_class'),
            'target'        => array_get($node, 'target') ? array_get($node, 'target') : 'not-self',
            'url'           => array_get($node, 'url'),
            'sort_order'    => $order,
        ];
        $item   = $menu->nodes()->where('id', $node['id'])->first();
        $result = ($item ? $item : new Model);
        foreach ($data as $key => $row) {
            $result->$key = $row;
        }
        $result->save();
        /**
         * Add messages when some error occurred
         */
        // if($result['error']) {
        //     flash_messages()->addMessages($result['messages'], 'danger');
        //     return;
        // }

        $children = array_get($node, 'children', null);
        /**
         * Save the children
         */
        if(is_array($children)) {
            foreach ($children as $key => $child) {
                $this->updateMenuNodes($create, $menu, $child, $key, $result->id);
            }
        }
    }

    /**
     * Get menu nodes
     * @param $menuId
     * @param null|int $parentId
     * @return mixed|null
     */
    public function menuNodes($menuId, $parentId = null)
    {
        if($menuId instanceof Menu) {
            $menu = $menuId;
        } else {
            $menu = $this->find($menuId);
        }
        if(!$menu) {
            return null;
        }


        if (!$this->allRelatedNodes) {
            $this->allRelatedNodes = $this->model
                ->where('menu_id', $menuId->id)
                ->select(['id', 'menu_id', 'parent_id', 'related_id', 'type', 'url', 'title', 'css_class', 'target'])
                ->orderBy('sort_order', 'ASC')
                ->get();
        }

        $nodes = $this->allRelatedNodes->where('parent_id', $parentId);

        $result = [];

        foreach ($nodes as $node) {
            $node->model_title = $node->title;
            $node->children = $this->menuNodes($menuId, $node->id);
            $result[] = $node;
            /**
             * Reset related nodes when done
             */
            if ($node->id == $nodes->last()->id && $parentId === null) {
                $this->allRelatedNodes = null;
            }
        }

        return collect($result);
    }


    /**
     * Delete items by id
     * @param EloquentBase|int|array|null $id
     * @return mixed
     */
    public function delete($id = null)
    {
        if (is_array($id)) {
            $this->model = $this->model->whereIn('id', $id);
        } elseif ($id instanceof Base || $id instanceof SoftDelete) {
            $this->model = $id;
        } else {
            $this->model = $this->model->where('id', '=', $id);
        }

        try {
            $this->model->delete();
        } catch (\Exception $e) {
            dd($e);
        }
    }

}
