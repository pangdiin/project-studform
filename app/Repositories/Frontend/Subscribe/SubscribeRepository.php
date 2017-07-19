<?php

namespace App\Repositories\Frontend\Subscribe;

use App\Models\Subscribe\Subscribe as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class SubscribeRepository.
 */
class SubscribeRepository extends BaseRepository
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
        DB::beginTransaction();
        try {
            $user = access()->user();
            $subscription = $user->subscription;
            
            if($subscription){ $subscription->update(['status' => ($subscription->isExpired() ? 2 : 0)]); }

            $data['membership_id'] = $request->membership_id;
            $data['status'       ] = 1; 
            $data['start_date'   ] = now();
            $subscription = $user->subscriptions()->create($data);
            DB::commit();
            return $subscription;
            
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'subscription']));
        }
    }
}