<?php
/**
 * Plugin Name: Ninja Popup
 * Plugin URI: 
 * Description: NInja Popup - is an fastest and easiest alternative to add business popup functionalities on your website.
 * Author: Light Plugins
 * Author URI: 
 * License: GPLv2 or later
 * Version: 1.3.1
 * Text Domain: ninjapopup
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('NINJAPOPUP_VERSION')) {
    
    define('NINJAPOPUP_VERSION', '1.0.0');
    define('NINJAPOPUP_DB_VERSION', 120);
    define('NINJAPOPUP_MAIN_FILE', __FILE__);
    define('NINJAPOPUP_BASENAME', plugin_basename(__FILE__));
    define('NINJAPOPUP_URL', plugin_dir_url(__FILE__));
    define('NINJAPOPUP_DIR', plugin_dir_path(__FILE__));

    class NinjaPopup
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
            load_plugin_textdomain('ninjapopup', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function loadDependencies()
        {
            require_once(NINJAPOPUP_DIR . 'app/autoload.php');
        }

        public function adminHooks()
        {
            // Register Admin menu
            $menu = new \NinjaPopup\Menu();
            $menu->register();

            // Top Level Ajax Handlers for reviews
            $ajaxHandler = new \NinjaPopup\Route\PopupHandler();
            $ajaxHandler->registerEndpoints();

            add_action('ninjapopup/render_admin_app', function () {
                $adminApp = new \NinjaPopup\Views\AdminApp();
                $adminApp->bootView();
            });

            //delete cache when data is updated
            add_action('ninja_popup_meta_updated', array('\NinjaPopup\Route\PopupHandler', 'deleteCache'));

            //remove all admin notice
            add_action('admin_init', function () {
                $disablePages = [
                    'ninjapopup',
                ];
                if (isset($_GET['page']) && in_array($_GET['page'], $disablePages)) {
                    remove_all_actions('admin_notices');
                }
            });
        }

        public function publicHooks()
        {
            add_shortcode('ninja_popup_layout', function ($args) {
                $args = shortcode_atts(array(
                    'id' => '',
                ), $args);

                if (!$args['id']) {
                    return;
                }

                $builder = new \NinjaPopup\Views\FrontendApp();
                return $builder->renderPopup($args['id']);
            });
        }
    }

    add_action('plugins_loaded', function () {
        (new NinjaPopup())->boot();
    });

} else {
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
    });
}