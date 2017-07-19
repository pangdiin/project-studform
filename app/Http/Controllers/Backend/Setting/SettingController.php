<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting as Model;
use App\Repositories\Backend\Setting\SettingRepository as Repository;
/**
 * Class SettingController.
 */
class SettingController extends Controller
{
	/**
	 * @var Setting $setting 
	 */
	protected $model;


    /**
     * @var Repository $setting 
     */
    protected $repo;

	/**
	 * Constructor
	 */
	function __construct(Model $model, Repository $repo)
	{
        $this->repo  = $repo;
		$this->model = $model;
	}

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $groups = config('setting');
        return view('backend.setting.index', compact('groups'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($key)
    { 
        if(!array_key_exists($key, config('setting'))){ abort(404); }
        $group = config('setting')[$key];
        $settings = $this->model->where('type', $key)->orderBy('display', 'ASC')->get();
        return view('backend.setting.show', compact('settings', 'group', 'key'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
    	$this->validate($request, [
            'color.*' => 'required|max:20',
            'text.*'  => 'required|max:255',
            'email.*' => 'required|email|max:255',
            'number.*'=> 'required|min:0',
    	]);
        $slide = $this->repo->store($request);
        $message = 'You have successfully updated site settings.';
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);

    }
}
