<?php

namespace App\Http\Controllers\Backend\Letter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Letter\LetterRepository as Repository;

use App\Models\Letter\Letter as Model;

class LetterController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.letter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.letter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'content'       => 'required|max:255',

        ]);

        $letter = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $letter->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.letter.index')->withFlashSuccess($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $letter)
    {
        return view('backend.letter.edit', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $letter)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'content'       => 'required|max:255',
        ]);
        $letter = $this->repo->store($request, $letter);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $letter->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.letter.index')->withFlashSuccess($message);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Model $letter)
    {
        $this->repo->destroy($letter);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $letter->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }
}
