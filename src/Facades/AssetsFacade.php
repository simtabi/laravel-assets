<?php

namespace Simtabi\Assets\Facades;

use Simtabi\Assets\Assets;
use Illuminate\Support\Facades\Facade;

class AssetsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Assets::class;
    }
}
