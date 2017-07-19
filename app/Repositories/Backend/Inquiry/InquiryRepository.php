<?php

namespace App\Repositories\Backend\Inquiry;

use App\Models\Inquiry\Inquiry as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

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
     * @var History slug $history_slug
     */
    protected $history_slug = 'Inquiry';

    /**
     * @param RoleRepository $role
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->select([
                'id', 'name', 'email', 'subject', 'created_at', 'updated_at'
            ]);

        if ($request->trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        // active() is a scope on the UserScope trait
        return $dataTableQuery;
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
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Inquiry']));
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
        return $request->only('name');

        // $data['name']           = strip_tags($request->name);
        // $data['email']          = $request->email;
        // $data['subject']        = $request->subject;
        // $data['contact_number'] = $request->contact_number;
        // $data['message']        = $request->message;

        // return $data;
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
            $inquiry = $model;
            if($model->delete()){
                $this->eventForceDeleted($inquiry);
                return true;
            }
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'Inquiry #' . $inquiry->id]));
        });

    }
   
}
