<?php

namespace App\Http\Controllers\Backend\Newsletter\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Newsletter\NewsletterRepository as Repository;

/**
 * Class NewsletterTableController.
 */
class NewsletterTableController extends Controller
{
    /**
     * @var Repository
     */
    protected $repo;

    /**
     * @param Repository $repo
     */
    public function __construct(Repository $repo)
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
            ->editColumn('status', function($subscriber){

                return [
                    'type' => $subscriber['status'] == "unsubscribed" ? 'danger' : 'success',
                    'label' => $subscriber['status'] == "unsubscribed" ? 'Unsubscribed' : 'Subscribed'
                ];

            })
            ->editColumn('last_changed', function($subscriber){
                return carbon($subscriber['last_changed'])->format(config('base.date_format'));
            })



        //     return [ 
        //     ['type' => 'show',      'link' => route('frontend.page.show'    , $this)],
        //     ['type' => 'edit',      'link' => route('admin.page.edit'       , $this)],
        //     ['type' => 'delete',    'link' => route('admin.page.destroy'    , $this)],
        // ];



            ->addColumn('actions', function ($subscriber) {
                $email   = $subscriber['email_address'];
                $link    = ['type' => 'custom', 'name' => 'btn_subscribe',          'class' => 'btn btn-success btn-xs', 'tooltip' => 'Re-Subscribe','icon' => 'fa fa-link' ,  'link' => route('admin.api.newsletter.resubscribe', $email)];
                $unlink = ['type' => 'custom', 'name' => 'btn_unsubscribe',        'class' => 'btn btn-warning btn-xs', 'tooltip' => 'Unsubscribe', 'icon' => 'fa fa-unlink' ,'link' => route('admin.api.newsletter.unsubscribe', $email)];
                $delete  = ['type' => 'custom', 'name' => 'btn_delete_subscriber',  'class' => 'btn btn-danger btn-xs' , 'tooltip' => 'Delete',      'icon' => 'fa fa-trash',  'link' => route('admin.api.newsletter.delete', $email)];

                return [ ($subscriber['status'] == "unsubscribed" ? $link : $unlink),  $delete ];

            })
            ->make(true);
    }
}
