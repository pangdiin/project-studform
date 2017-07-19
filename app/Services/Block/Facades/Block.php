<?php

namespace App\Services\Block\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Block.
 */
class Block extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'block';
    }
}
