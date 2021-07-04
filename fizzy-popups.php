<?php
/**
 * Plugin Name: Fizzy Popups
 * Plugin URI: https://wordpress.org/plugins/fizzy-popups
 * Description: Fizzy Popups - is the fastest and easiest alternative to add business popup functionalities on your website.
 * Author: Light Plugins
 * Author URI: https://profiles.wordpress.org/lovelightplugins
 * License: GPLv2 or later
 * Version: 1.2.0
 * Text Domain: fizzypopups
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('FIZZYPOPUPS_VERSION')) {
    define('FIZZYPOPUPS_VERSION', '1.2.0');
    define('FIZZYPOPUPS_DB_VERSION', 217);
    define('FIZZYPOPUPS_MAIN_FILE', __FILE__);
    define('FIZZYPOPUPS_BASENAME', plugin_basename(__FILE__));
    define('FIZZYPOPUPS_URL', plugin_dir_url(__FILE__));
    define('FIZZYPOPUPS_DIR', plugin_dir_path(__FILE__));

    class FizzyPopups
    {
        public function boot()
        {
            $this->textDomain();
            $this->loadDependencies();

            if (is_admin()) {
                $this->adminHooks();
            }
            $this->publicHooks();
        }

        public function textDomain()
        {
            load_plugin_textdomain('fizzypopups', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function loadDependencies()
        {
            require_once(FIZZYPOPUPS_DIR . 'app/autoload.php');
        }

        public function adminHooks()
        {
            // Register Admin menu
            $menu = new \FizzyPopups\Menu();
            $menu->register();

            // Top Level Ajax Handlers for reviews
            $ajaxHandler = new \FizzyPopups\Route\PopupHandler();
            $ajaxHandler->registerEndpoints();

            add_action('fizzypopups/render_admin_app', function () {
                $adminApp = new \FizzyPopups\Views\AdminApp();
                $adminApp->bootView();
            });

            //delete cache when data is updated
            add_action('fizzy_popup_meta_updated', array('\FizzyPopups\Route\PopupHandler', 'deleteCache'));

            //remove all admin notice
            add_action('admin_init', function () {
                $disablePages = [
                    'fizzypopups',
                ];
                if (isset($_GET['page']) && in_array($_GET['page'], $disablePages)) {
                    remove_all_actions('admin_notices');
                }
            });
        }

        public function publicHooks()
        {
            if (defined('ELEMENTOR_VERSION')) {
                new \FizzyPopups\Widgets\ElementorHelper();
            }

            add_shortcode('fizzy_popup_layout', function ($args) {
                $args = shortcode_atts(array(
                    'id' => '',
                ), $args);

                if (!$args['id']) {
                    return;
                }

                $builder = new \FizzyPopups\Views\FrontendApp();
                return $builder->renderPopup($args['id']);
            });
        }
    }

    add_action('plugins_loaded', function () {
        (new FizzyPopups())->boot();
    });

} else {
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
    });
}