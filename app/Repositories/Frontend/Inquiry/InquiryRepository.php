<?php

namespace App\Repositories\Frontend\Inquiry;

use App\Models\Inquiry\Inquiry as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Notifications\Frontend\Inquiry\InquiryEmail;

/**
 * Class InquiryRepository.
 */
class InquiryRepository extends BaseRepository
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
                $inquiry = $model;
            }else{
                $inquiry = $this->model->create($data);
                $this->sendEmail($inquiry);
            }
            DB::commit();
            return $inquiry;
        } catch (\Exception $e) {
            DB::rollback();
            $this->exceptions($e->getMessage());
            // $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Inquiry']));
        }
    }


    /**
     * Sending Email
     * @param Inquiry $inquiry
     */
    public function sendEmail($inquiry)
    {
        $inquiry->notify(new InquiryEmail());
    }

    /**
     * Create stub in storing Inquiries
     * @param Request $request
     * @param Model $model
     * @return array $data
     */
    public function generateStub($request, $model=null)
    {
        return $request->except(['_token']);
    }

   
}
