<?php

namespace App\Repositories\Frontend\Invite;

use App\Models\Invite\Invite as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class InviteRepository.
 */
class InviteRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Inquiry Model
     */
    protected $model;

    /**
     * @param RoleRepository $role
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
    public function store($request, $model = null)
    {

        $data = $this->generateStub($request, $model);

        DB::beginTransaction();

        try {
            if($model){
                $model->update($data);
                $invite = $model;
            }else{
                $invite = $this->model->create($data);
            }
            DB::commit();
            return $invite;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Invite']));
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
        $data = $request->except(['_token']);
        $data['status'] = 1;
        return $data;
    }

   
}
