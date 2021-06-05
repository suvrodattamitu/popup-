<?php
/**
 * Autoloader
 *
 * @package FizzyPopups
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('FizzyPopupsAutoload')) {
    /**
     * Plugin autoloader.
     *
     * @param $class
     * @since 1.0.0
     *
     */
    function FizzyPopupsAutoload($class)
    {
        $namespace = 'FizzyPopups';
        if (strpos($class, $namespace) !== 0) {
            return;
        }
        $unprefixed = substr($class, strlen($namespace));
        $file_path = str_replace('\\', DIRECTORY_SEPARATOR, $unprefixed);

        $file = dirname(__FILE__) . $file_path . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
    spl_autoload_register('FizzyPopupsAutoload');
}
