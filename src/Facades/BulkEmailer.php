<?php

namespace yunusasuroglu\BulkEmailler\Facades;

use Illuminate\Support\Facades\Facade;

class BulkEmailler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bulk-emailer';
    }
}
