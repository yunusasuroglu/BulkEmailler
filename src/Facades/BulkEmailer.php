<?php

namespace yunusasuroglu\BulkEmailer\Facades;

use Illuminate\Support\Facades\Facade;

class BulkEmailer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bulk-emailer';
    }
}
