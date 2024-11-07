<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit66cace07540b4a08be02eeb0bb6c862d
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MilosNisevic\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MilosNisevic\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit66cace07540b4a08be02eeb0bb6c862d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit66cace07540b4a08be02eeb0bb6c862d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit66cace07540b4a08be02eeb0bb6c862d::$classMap;

        }, null, ClassLoader::class);
    }
}
