<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit70c2a839e506aacf99ef654a0263a68d
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit70c2a839e506aacf99ef654a0263a68d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit70c2a839e506aacf99ef654a0263a68d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit70c2a839e506aacf99ef654a0263a68d::$classMap;

        }, null, ClassLoader::class);
    }
}