<?php

namespace Zhelyazko777\LaravelSimpleMapper;

class SimpleMapper
{
    public static function map(object $source, object $destination, array $customResolvers = []): object
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
            $setterFullName = 'set'.ucfirst($setter);
            if (array_key_exists($setter, $customResolvers)) {
                $resolvedValue = $customResolvers[$setter]($source, $destination);
                $destination->{$setterFullName}($resolvedValue);
            } else if (in_array($setter, $sourceGetterNames)) {
                $getterFullName = 'get'.ucfirst($setter);
                $destination->{$setterFullName}($source->{$getterFullName}());
            }
        }

        return $destination;
    }
}
