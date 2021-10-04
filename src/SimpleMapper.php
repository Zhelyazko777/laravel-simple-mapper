<?php

namespace Zhelyazlo777\LaravelSimpleMapper;

class SimpleMapper
{
    public function map(object $source, object $destination): object
    {
        /** @var SimpleMapperServiceInterface $service */
        $service = app()->get(SimpleMapperServiceInterface::class);
        return $service->map($source, $destination);
    }
}
