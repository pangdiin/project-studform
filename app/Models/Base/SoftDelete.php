<?php 

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDelete extends Model 
{
	use SoftDeletes;

	/**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'. $this->link_show .'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.view').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'. $this->link_update .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDestroyButtonAttribute()
    {
        return '<a name="btn_delete" href="'. $this->link_delete .'" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a name="btn_restore" href="'. $this->link_restore .'" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.restore').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getForceDeleteButtonAttribute()
    {
    	return '<a name="btn_force" href="'. $this->link_force .'" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.force').'"></i></a> ';
    }


    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return $this->getRestoreButtonAttribute().
                $this->getForceDeleteButtonAttribute();
        }

        return
            $this->getShowButtonAttribute().
            $this->getEditButtonAttribute().
            $this->getDestroyButtonAttribute();
    }
}

