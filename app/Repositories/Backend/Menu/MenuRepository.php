<?php

namespace App\Repositories\Backend\Menu;

use App\Models\Menu\Menu as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Menu\NodeRepository;
/**
 * Class MenuRepository.
 */
class MenuRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Menu Model
     */
    protected $model;

    /**
     * @var NodeRepository
     */
    protected $node;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Menu';

    /**
     * @param Model $model
     */
    public function __construct(Model $model, NodeRepository $node)
    {
        $this->model = $model;
        $this->node  = $node ;
    }

    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        return $this->query()
            ->select([
                'id', 'name', 'slug', 'position', 'updated_at'
            ]);
    }

    /**
     * @param Request $request
     * @param Model  $model
     *
     * @return static
     */
    public function store($request, $model = null)
    {
        $data = $this->generateStub($request, $model);
        DB::beginTransaction();
        try {
            $process = $model ? 'update' : 'create';
            if($model){
                $model->update($data);
                $menu = $model;
                $this->eventUpdated($menu);
                $this->deleteNodeStructure($menu, $request, true);
                $this->menuStructure($menu, $request, true);
            }else{
                $data['depth'] = 1;
                $menu = $this->model->create($data);
                $this->eventCreated($menu);
            }

            menu()->cacheSave();

            DB::commit();
            return $menu;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Menu']));
        }
    }

    /**
     * Create stub in storing Inquiries
     * @param Request $request
     * @param Model $model
     * @return array $data
     */
    public function generateStub($request, $model=null)
    {
        if(config('menu.can_add')){ return $request->only(['name', 'position']); }
        return $request->only(['name']);
    }


    /**
     * @param Model $model
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function destroy($model)
    {
        DB::transaction(function () use ($model) {
            $deleted = $model;
            File::delete($model->path);
            if($model->delete()){
                $this->eventDeleted($deleted);
                menu()->cacheSave();
                return true;
            }
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'Menu #' . $deleted->id]));
        });

    }

    /**
     * @param Model $menu
     *
     * @throws GeneralException
     *
     * @return request
     */
    public function menuStructure($menu, $request, $create=false)
    {
        $structure = $request->menu_structure;
        if (!is_array($structure)) {
            $structure = json_decode($structure, true);
        }
        $nodes = collect();
        foreach ($structure as $order => $node) {
            $nodes = $nodes->push($this->node->updateMenuNodes($create, $menu, $node, $order));
        }
    }



    /**
     * @param Model $menu
     *
     * @throws GeneralException
     *
     * @return request
     */
    public function deleteNodeStructure($menu, $request)
    {
        $nodes = $request->delete_nodes;
        if (!is_array($nodes)) {
            $nodes = json_decode($nodes ?? []);
        }
        return $this->node->delete($nodes);
    }
   
}
