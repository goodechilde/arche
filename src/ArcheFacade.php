<?php

namespace Goodechilde\Arche;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Goodechilde\Arche\Skeleton\SkeletonClass
 */
class ArcheFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cray';
    }
}
