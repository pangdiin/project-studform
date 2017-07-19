<?php

namespace App\Http\Controllers\Backend\Letter\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Letter\LetterRepository;
use App\Models\Letter\Letter as Model;

class LetterTableController extends Controller
{
    /**
     * @var ProjectRepository
     */
    protected $repo;

    /**
     * @param ProjectRepository $repo
     */
    public function __construct(LetterRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Datatables::of($this->repo->getForDataTable($request))
            ->editColumn('updated_at', function($letter){
                return $letter->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($letter) {
                return $letter->actions();
            })
            ->withTrashed()
            ->make(true);
    }


    /**
     * @param Request $request
     *
     * @return json
     */
    public function show(Request $request)
    {
        return response()->json($request->all());
    }
}
