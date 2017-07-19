<?php

namespace App\Http\Controllers\Backend\Tag\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Tag\TagRepository;
use App\Models\Tag as Model;

/**
 * Class TagTableController.
 */
class TagTableController extends Controller
{
    /**
     * @var TagRepository
     */
    protected $repo;

    /**
     * @param TagRepository $repo
     */
    public function __construct(TagRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request, $type)
    {
        return Datatables::of($this->repo->getForDataTable($request, $type))
            ->editColumn('image', function($tag){
                return file_exists($tag->image) ? asset($tag->image) : asset('img/no-image.png');
            })
            ->editColumn('updated_at', function($tag){
                return $tag->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($tag) {
                return $tag->actions();
            })
            ->withTrashed()
            ->make(true);
    }


    /**
     * @param Request $request
     *
     * @return json
     */
    public function show(Request $request, $type)
    {
        $tag = Model::where('type', $type['key'])->where('id', $request->id)->firstOrFail();
        return response()->json($tag);
    }
}
