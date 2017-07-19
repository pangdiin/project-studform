<?php

namespace App\Repositories\Backend\Setting;

use App\Models\Setting as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;
/**
 * Class SettingRepository.
 */
class SettingRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Setting Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Setting';

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @param Model  $model
     *
     * @return static
     */
    public function store($request)
    {

        $data   = $this->generateStub($request);
        DB::beginTransaction();

        try {
            foreach ($data as $key => $set) {
                $this->model->where('key', $key)->update(['value' => $set]);
            }
            setting()->cacheSettings();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.updated', ['attribute' => 'Setting']));
        }
    }

    /**
     * Create stub in storing Inquiries
     * @param Request $request
     * @return array $data
     */
    public function generateStub($request)
    {
        $data = [];
        foreach ($request->except(['_token', '']) as $t => $type) {
            if(is_array($type)){
                $data = array_merge($type, $data); 
            }
        }
        return $data;
    }
   
}
