<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6f303bcc0b3b4fd56e7f1c19b067898
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Ilovepdf\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ilovepdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/ilovepdf/ilovepdf-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6f303bcc0b3b4fd56e7f1c19b067898::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6f303bcc0b3b4fd56e7f1c19b067898::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf6f303bcc0b3b4fd56e7f1c19b067898::$classMap;

        }, null, ClassLoader::class);
    }
}
