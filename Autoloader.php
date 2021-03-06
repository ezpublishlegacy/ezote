<?php

namespace ezote;

class Autoloader
{
    public static $extensionDir = null;
    public static $registered = false;
    /**
     * Register ezote/Autoloader::autoload as autoloader
     */
    static public function register($extensionDir = false)
    {
        if (!static::$registered)
        {
            static::$extensionDir = $extensionDir ?: \eZExtension::baseDirectory();
            static::$registered = spl_autoload_register(array(new self, 'autoload'));
        }
    }

    /**
     * Autoloads namespaced extension classes
     *
     * @param string $class A class name.
     * @return boolean Returns true if the class has been loaded
     */
    static public function autoload($class)
    {
        $file = static::$extensionDir . '/' . str_replace('\\', '/', $class) .'.php';
        if (file_exists($file))
            return require $file;
        return false;
    }
}
