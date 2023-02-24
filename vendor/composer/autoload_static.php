<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite36b4e8a85baa0a3840c38ca68b7946a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite36b4e8a85baa0a3840c38ca68b7946a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite36b4e8a85baa0a3840c38ca68b7946a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite36b4e8a85baa0a3840c38ca68b7946a::$classMap;

        }, null, ClassLoader::class);
    }
}