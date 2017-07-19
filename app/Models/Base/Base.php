<?php 

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Base extends Model 
{
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
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute().
            $this->getEditButtonAttribute().
            $this->getDestroyButtonAttribute();
    }
}

