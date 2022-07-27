<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitab21eb92da12abf3db9bf25033ba42fd
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

        spl_autoload_register(array('ComposerAutoloaderInitab21eb92da12abf3db9bf25033ba42fd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitab21eb92da12abf3db9bf25033ba42fd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitab21eb92da12abf3db9bf25033ba42fd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
