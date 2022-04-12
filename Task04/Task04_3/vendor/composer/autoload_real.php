<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit00f9d83bc697cf7ad9cfad53cd285663
=======
class ComposerAutoloaderInit94e5ede07ad723c34199b156f2ad9973
>>>>>>> a65b78d675ce63b78ed0ee19e429ca0ac48c4067
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

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit00f9d83bc697cf7ad9cfad53cd285663', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(\dirname(__FILE__)));
        spl_autoload_unregister(array('ComposerAutoloaderInit00f9d83bc697cf7ad9cfad53cd285663', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInit94e5ede07ad723c34199b156f2ad9973', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(\dirname(__FILE__)));
        spl_autoload_unregister(array('ComposerAutoloaderInit94e5ede07ad723c34199b156f2ad9973', 'loadClassLoader'));
>>>>>>> a65b78d675ce63b78ed0ee19e429ca0ac48c4067

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            require __DIR__ . '/autoload_static.php';

<<<<<<< HEAD
            call_user_func(\Composer\Autoload\ComposerStaticInit00f9d83bc697cf7ad9cfad53cd285663::getInitializer($loader));
=======
            call_user_func(\Composer\Autoload\ComposerStaticInit94e5ede07ad723c34199b156f2ad9973::getInitializer($loader));
>>>>>>> a65b78d675ce63b78ed0ee19e429ca0ac48c4067
        } else {
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
<<<<<<< HEAD
            $includeFiles = Composer\Autoload\ComposerStaticInit00f9d83bc697cf7ad9cfad53cd285663::$files;
=======
            $includeFiles = Composer\Autoload\ComposerStaticInit94e5ede07ad723c34199b156f2ad9973::$files;
>>>>>>> a65b78d675ce63b78ed0ee19e429ca0ac48c4067
        } else {
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
<<<<<<< HEAD
            composerRequire00f9d83bc697cf7ad9cfad53cd285663($fileIdentifier, $file);
=======
            composerRequire94e5ede07ad723c34199b156f2ad9973($fileIdentifier, $file);
>>>>>>> a65b78d675ce63b78ed0ee19e429ca0ac48c4067
        }

        return $loader;
    }
}

<<<<<<< HEAD
/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire00f9d83bc697cf7ad9cfad53cd285663($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
=======
function composerRequire94e5ede07ad723c34199b156f2ad9973($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
>>>>>>> a65b78d675ce63b78ed0ee19e429ca0ac48c4067
    }
}