<?php
/**
 * Autoloader
 *
 * @package NinjaPopups
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('NinjaPopupsAutoload')) {
    /**
     * Plugin autoloader.
     *
     * @param $class
     * @since 1.0.0
     *
     */
    function NinjaPopupsAutoload($class)
    {
        $namespace = 'NinjaPopups';
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
    spl_autoload_register('NinjaPopupsAutoload');
}
