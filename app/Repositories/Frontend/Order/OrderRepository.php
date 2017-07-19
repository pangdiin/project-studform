<?php

namespace App\Repositories\Frontend\Order;

use App\Models\Order\Order as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Forex;
use Rate;

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Order Model
     */
    protected $model;


    /**
     * @param Model $model
     * @param $rate
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        return $this->model::where('user_id', access()->id())
            ->select(DB::raw('count(*) as order_count, sum(amount) as total_amount, type'))
            ->groupBy('type')
            ->get();
    }

    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function getForDataTable($request, $type)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        // $rates = $this->rate->rate('AUDUSD');
        // $rates = collect(Forex::fetch()->rates());
        // $rates = collect();
        $rates = Rate::latest(config('base.currencies.against'));

        return $this->query()
            ->where('user_id', access()->id())
            ->where('type', $type['key'])
            ->select([
                'id', 'type', 'order_number', 'currency', 'base_currency', 'amount', 'due_date', 'entry_rate', 'exit_rate', 'created_at'
            ])->get()->each(function($item, $key) use($type, $rates) {
                $item->start_date   = $item->created_at->format('m/d/Y');
                $item->end_date     = $item->due_date->format('m/d/Y');
                $item->due_date2     = $item->due_date->format('Y-m-d');
                $item->exit_rate    = $item->exit_rate;
                $item->isExpired    = $item->isExpired();
                $item->rate = 1;
                if($item->base_currency != $item->currency){
                    $item->rate = $rates->where('currency', $item->base_currency)->first()->rates[$item->currency]; 
                }
            });
    }

    /**
     * @param Request $request
     * @param Order Type  $type
     * @param Model  $model
     *
     * @return static
     */
    public function store($request, $type, $model = null)
    {
        $data = $this->generateStub($request, $type, $model);

        DB::beginTransaction();

        try {
            $process = $model ? 'update' : 'create';
            if($model){
                $model->update($data);
                $slide = $model;
            }else{
                $data['path'] = asset('img/no-default.png');
                $slide = $this->model->create($data);
            }
            DB::commit();
            return $slide;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Inquiry']));
        }
    }

    /**
     * @param Model $model
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function destroy($model)
    {
        DB::transaction(function () use ($model) {
            $deleted = $model;
            if($model->delete()){
                return true;
            }
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'Order #' . $deleted->order_number]));
        });

    }


    public function generateStub($request, $type, $model=null)
    {
        if($model){ return $request->only(['order_number', 'amount', 'due_date', 'currency']); }
        $rate = 0;

        if($type['key'] == 1){
            $rate = Rate::pair('AUD', $request->currency);
            // $rate = Rate::get('latest', ['base'=>'AUD','symbols' => $request->currency]);
        //     $rate = Forex::from('aud')->to(strtolower($request->currency))->convert();
        }else{
            $rate = Rate::pair($request->currency, 'AUD');
            // $rate = Rate::get('latest', ['base'=>$request->currency,'symbols' => 'AUD']);
        //     $rate = Forex::from(strtolower($request->currency))->to('aud')->convert();
        }
        // $rate = $this->rate->rate($type['key'] == 1 ? 'AUD' . $request->currency : $request->currency . 'AUD');
        // echo var_dump($rate);
        // dd($rate);
        // $rate = 0;

        $data['order_number'    ] = $request->order_number;
        $data['amount'          ] = $request->amount;
        $data['due_date'        ] = carbon($request->due_date);
        if($type['key'] == 1){
            $data['base_currency'   ] = 'AUD';
            $data['currency'        ] = $request->currency;
        }else{
            $data['currency'        ] = 'AUD';
            $data['base_currency'   ] = $request->currency;
        }
        $data['type'            ] = $type['key'];
        // $data['entry_rate'      ] = ($type['key'] != 1 ? $rate->rates->AUD : $rate->rates->{$request->currency});
        $data['entry_rate'      ] = $rate;
        $data['user_id'         ] = access()->id();
        return $data;
    }
   
}
