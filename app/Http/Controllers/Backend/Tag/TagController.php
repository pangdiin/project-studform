<?php

namespace App\Http\Controllers\Backend\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Tag\TagRepository as Repository;

use App\Models\Tag as Model;
/**
 * Class TagController.
 */
class TagController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;


    function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }


    /**
     * @param Config Tag Type $type
     *
     * @return \Illuminate\View\View
     */
    public function index($type)
    {
        return view('backend.tag.index', compact('type'));
    }

    /**
     * @param Config Tag Type $type, Tag $tag
     * 
     * @return \Illuminate\View\View
     */
    public function edit($type, $slug)
    {
    	$tag = Model::whereSlug($slug)->where('type', $type['key'])->firstOrFail();

        return view('backend.tag.edit', compact('type', 'tag'));
    }

    public function update(Request $request, $type, $slug)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'description'   => 'required|max:255',
            'image.*'       => 'mimes:jpeg,jpg,png',
        ]);
        $model = Model::whereSlug($slug)->where('type', $type['key'])->firstOrFail();
        if(!$model instanceof Model){
            $model = Model::where('id', $request->id)->where('type', $type['key'])->firstOrFail();
        }
        $this->repo->store($request, $type, $model);
        return redirect()->route('admin.tag.index', $type['route'])->withFlashSuccess(trans('base.alerts.success.messages.updated' , ['attribute' => $request->name]));
    }

    /**
     * @param $request
     */
    public function store(Request $request, $type)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'description'   => 'sometimes|required|max:255',
            'image.*'       => 'sometimes|required|mimes:jpeg,jpg,png',
        ]);
        $this->repo->store($request, $type);
        return response()->json(['message' => trans('base.alerts.success.messages.created', ['attribute' => $request->name])]);
        
    }

    /**
     * @param Request $request
     *
     * @return json
     */
    public function destroy(Request $request, $type, Model $tag)
    {
        $this->repo->destroy($tag);
        return response()->json(['message' => trans('base.alerts.success.messages.deleted', ['attribute' => 'Tag # ' . $tag->id])]);
    }
}
