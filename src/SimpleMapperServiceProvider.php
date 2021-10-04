<?php

namespace Zhelyazlo777\LaravelSimpleMapper;

use Illuminate\Support\ServiceProvider;

class SimpleMapperServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, string>
     */
    public array $bindings = [
        SimpleMapperServiceInterface::class => SimpleMapperService::class,
    ];

    public function register()
    {
        $this->app->bind('simpleMapper', function(){
            return new SimpleMapper;
        });
    }
}
