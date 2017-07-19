<?php

namespace App\Http\Controllers\Backend\Block;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Block\BlockRepository as Repository;

use App\Models\Block as Model;


/**
 * Class BlockController.
 */
class BlockController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;

    /**
     * @var $rules
     */
    protected $rules;

    function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.block.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function deleted()
    {
        return view('backend.block.deleted');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // if(!config('base.block.can_add')){ abort(404); }
        return view('backend.block.create');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Model $block)
    {
        return view('backend.block.edit', compact('block'));
    }

    /**
     * @param Request $request 
     * @return $block
     */
    public function store(Request $request)
    {
        // if(!config('base.block.can_add')){ abort(404); }
        
        $this->validate($request, [
            'name'          => 'required|max:255',
            // 'position'      => 'required|in:' . implode(',', array_keys(config('menu.position'))),
            'content'       => 'required',
            'description'   => 'max:255',
        ]);

        $block = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $block->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.block.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request, Model $block
     * @return $block
     */
    public function update(Request $request, Model $block)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            // 'position'      => 'required|in:' . implode(',', array_keys(config('menu.position'))),
            'content'       => 'required',
            'description'   => 'max:255',
        ]);
        $block = $this->repo->store($request, $block);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $block->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.block.edit', $block)->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Model $block
     * @return $response
     */
    public function destroy(Request $request, Model $block)
    {
        $this->repo->destroy($block);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $block->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }
   
}
