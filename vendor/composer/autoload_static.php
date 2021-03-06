<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit616e60627892c7cea7dbf59d00169e9a
{
    public static $files = array (
        '4d9749224a3729f522da72d4c92f9b47' => __DIR__ . '/../..' . '/source/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit616e60627892c7cea7dbf59d00169e9a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit616e60627892c7cea7dbf59d00169e9a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
