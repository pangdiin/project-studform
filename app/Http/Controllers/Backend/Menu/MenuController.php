<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Menu\Menu as Model;
use App\Repositories\Backend\Menu\MenuRepository as Repository;
use App\Repositories\Backend\Menu\NodeRepository;

/**
 * Class MenuController.
 */
class MenuController extends Controller
{
	/**
     * @var $repo
     */
    protected $repo;

    /**
     * @var $node
     */
    protected $node;

    /**
     * @var $rules
     */
    protected $rules;

    function __construct(Repository $repo, NodeRepository $node)
    {
        $this->repo = $repo;
        $this->node = $node;
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.menu.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Model $menu)
    {
        $widgets = [];
        foreach (config('menu.menus') as $m => $menus) {
            $class = new $menus['class']();
            $widgets[$m] = $class->select($menus['fields'])->get()
                ->each(function($item) use($menus){
                    $item->name     = ($item->name     ? $item->name   : $item->title);
                    $item->title    = ($item->title    ? $item->title  : $item->name );
                    $item->link     = route($menus['url'], $item);
                });
        }
        $nodes = json_encode($this->node->menuNodes($menu));

        return view('backend.menu.edit', compact('menu', 'widgets', 'nodes'));
    }


    /**
     * @param Request $request 
     * @return $menu
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'	        => 'required|max:255',
            'position'      => 'sometimes|required|in:' . implode(',',array_keys(config('menu.position')))
        ]);
        $menu = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $menu->title ? $menu->title : 'Menu # ' . $menu->id ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.menu.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request 
     * @return $menu
     */
    public function update(Request $request, Model $menu)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'position'      => 'sometimes|required|in:' . implode(',',array_keys(config('menu.position')))
        ]);
        $menu = $this->repo->store($request, $menu);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $menu->title ? $menu->title : 'Menu # ' . $menu->id ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.menu.index')->withFlashSuccess($message);
    }
}
