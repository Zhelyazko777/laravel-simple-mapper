<?php

namespace Zhelyazlo777\LaravelSimpleMapper;

use Illuminate\Support\Facades\Facade;

class SimpleMapperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simpleMapper';
    }
}
