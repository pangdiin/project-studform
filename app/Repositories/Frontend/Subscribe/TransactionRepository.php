<?php

namespace App\Repositories\Frontend\Subscribe;

use App\Models\Subscribe\Transaction as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class TransactionRepository.
 */
class TransactionRepository extends BaseRepository
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
     * @param array $data
     * @param Model  $model
     *
     * @return static
     */
    public function store($data)
    {
        DB::beginTransaction();
        try {
            $user = access()->user();
            $subscription = $user->subscription;
            if($subscription){ $subscription->update(['status' => 0]); }

            $subscription = $user->subscriptions()->create([
                'membership_id' => $data['membership_id'],
                'status'        => 1,
                'start_date'    => now()
            ]);
            $paypal = $data['result'];
            $transaction = $subscription->transactions()->create([
                'amount'        => $paypal->transactions[0]->amount->total,
                'email'         => $paypal->payer->payer_info->email,
                'first_name'    => $paypal->payer->payer_info->first_name,
                'last_name'     => $paypal->payer->payer_info->last_name,
                'payer_id'      => $paypal->payer->payer_info->payer_id,
                'payment_id'    => $data['payment_id']
            ]);

            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions('Failed Processing your payment.');
        }
    }   
}