<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef439a18992321da2ec3d44a7a84d249
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef439a18992321da2ec3d44a7a84d249::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef439a18992321da2ec3d44a7a84d249::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitef439a18992321da2ec3d44a7a84d249::$classMap;

        }, null, ClassLoader::class);
    }
}