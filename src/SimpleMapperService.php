<?php

namespace Zhelyazko777\LaravelSimpleMapper;

class SimpleMapperService
{
    public function map(object $source, object $destination): object
    {
        $sourceGetterNames = array_map(
            fn ($getter) => lcfirst(preg_replace('/^get/', '', $getter)),
            array_filter(
                get_class_methods($source),
                fn ($m) => str_starts_with($m, 'get')
            )
        );

        $destinationSetterNames = array_map(
            fn ($setter) => lcfirst(preg_replace('/^set/', '', $setter)),
            array_filter(
                get_class_methods($destination),
                fn ($m) => str_starts_with($m, 'set')
            )
        );
        foreach ($destinationSetterNames as $setter)
        {
            if (in_array($setter, $sourceGetterNames)) {
                $setterFullName = 'set'.ucfirst($setter);
                $getterFullName = 'get'.ucfirst($setter);
                $destination->{$setterFullName}($source->{$getterFullName}());
            }
        }

        return $destination;
    }
}
