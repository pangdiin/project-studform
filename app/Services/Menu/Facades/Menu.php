<?php

namespace App\Services\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Menu.
 */
class Menu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
