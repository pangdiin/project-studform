<?php

namespace App\Repositories;

use App\Events\Backend\Base\Created;
use App\Events\Backend\Base\Updated;
use App\Events\Backend\Base\Deleted;
use App\Events\Backend\Base\Restored;
use App\Events\Backend\Base\ForceDeleted;

use App\Exceptions\GeneralException;

/**
 * Class BaseRepository.
 */
class BaseRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->query()->count();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }

    /**
     * @return GeneralException
     */
    public function exceptions($label)
    {
        throw new GeneralException($label);
    }

    /**
     * @param $content
     */
    public function eventCreated($content)
    {
        event(new Created($this->history_slug, $content));
    }

    /**
     * @param $content
     */
    public function eventUpdated($content)
    {
        event(new Updated($this->history_slug, $content));
    }

    /**
     * @param $content
     */
    public function eventDeleted($content)
    {
        event(new Deleted($this->history_slug, $content));
    }

    /**
     * @param $content
     */
    public function eventRestored($content)
    {
        event(new Restored($this->history_slug, $content));
    }

    /**
     * @param $content
     */
    public function eventForceDeleted($content)
    {
        event(new ForceDeleted($this->history_slug, $content));
    }
}
