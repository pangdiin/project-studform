<?php

namespace App\Http\Controllers\Backend\Slide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Slide\SlideRepository as Repository;

use App\Models\Slide as Model;


/**
 * Class SlideController.
 */
class SlideController extends Controller
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

        $this->rules = [
            'image'         => 'required|mimes:jpeg,jpg,png|
                                dimensions:
                                    max_width='. config('base.slide.max_width') .',
                                    max_height='. config('base.slide.max_height'),
            'title'         => 'sometimes|required|max:255',
            'description'   => 'sometimes|required'
        ];

    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.slide.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.slide.create');
    }

    /**
     * @param Request $request 
     * @return $slide
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|mimes:jpeg,jpg,png|
                                dimensions:
                                    max_width='. config('base.slide.max_width') .',
                                    max_height='. config('base.slide.max_height'),
            'title'         => 'sometimes|required|max:255',
            // 'description'   => 'sometimes|required'
        ]);
        $slide = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $slide->title ? $slide->title : 'Slide # ' . $slide->id ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.slide.index')->withFlashSuccess($message);
    }


    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Model $slide)
    {
        return view('backend.slide.edit', compact('slide'));
    }
    
    /**
     * @param Request $request, Slide $slide
     * @return $slide
     */
    public function update(Request $request, Model $slide)
    {
        $this->validate($request, [
            'image'         => 'mimes:jpeg,jpg,png|
                                dimensions:
                                    max_width='. config('base.slide.max_width') .',
                                    max_height='. config('base.slide.max_height'),
            'title'         => 'sometimes|required|max:255',
            'description'   => 'sometimes|required'
        ]);
        $slide = $this->repo->store($request, $slide);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $slide->title ? $slide->title : 'Slide # ' . $slide->id ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Slide $slide
     * @return $response
     */
    public function destroy(Request $request, Model $slide)
    {
        $this->repo->destroy($slide);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $slide->title ? $slide->title : 'Slide # ' . $slide->id ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }


}
