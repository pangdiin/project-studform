<?php

namespace App\Services\Setting\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Setting.
 */
class Setting extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
