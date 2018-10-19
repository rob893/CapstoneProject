<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8160d70948a3affc31fd9c5a06d2a7fc
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CurriculumForecaster\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CurriculumForecaster\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/../..' . '/src/DataSources',
            2 => __DIR__ . '/../..' . '/src/SDKs',
            3 => __DIR__ . '/../..' . '/src/Factories',
            4 => __DIR__ . '/../..' . '/src/FuturePredictors',
            5 => __DIR__ . '/../..' . '/src/RelevancyRules',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8160d70948a3affc31fd9c5a06d2a7fc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8160d70948a3affc31fd9c5a06d2a7fc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
