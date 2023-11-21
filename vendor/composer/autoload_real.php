<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbdcdc2c69b3cbf3c8f20ce3ac50cb8e3
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitbdcdc2c69b3cbf3c8f20ce3ac50cb8e3', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbdcdc2c69b3cbf3c8f20ce3ac50cb8e3', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbdcdc2c69b3cbf3c8f20ce3ac50cb8e3::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}