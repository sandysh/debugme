<?php

namespace Sandysh\Debugme;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sandysh\Debugme\Skeleton\SkeletonClass
 */
class DebugmeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'debugme';
    }
}
