<?php

namespace Zhelyazlo777\LaravelSimpleMapper;

interface SimpleMapperServiceInterface
{
    public function map(object $source, object $destination): object;
}