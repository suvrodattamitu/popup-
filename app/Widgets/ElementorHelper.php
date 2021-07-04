<?php

namespace FizzyPopups\Widgets;
use Elementor\Plugin as Elementor;
use FizzyPopups\Widgets\PopupWidget;

class ElementorHelper
{
    public function __construct()
    {
        add_action( 'elementor/widgets/widgets_registered', array($this, 'init_widgets') );
    }

    public function init_widgets()
    {
        $widgets_manager = Elementor::instance()->widgets_manager;

        if ( file_exists( FIZZYPOPUPS_DIR.'app/Widgets/PopupWidget.php' ) ) {
            require_once FIZZYPOPUPS_DIR.'app/Widgets/PopupWidget.php';
            $widgets_manager->register_widget_type(new PopupWidget());
        }
    }

    public static function getPopups()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "posts";
        $postType = 'fizzy_popup';
        $postStatus = 'publish';
        $allPopups = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type='$postType' AND post_status='$postStatus' ORDER BY ID DESC");

        $popups = array();
        if (empty($popups)) {
            $popups[0] = esc_html__('Select a Popop', 'fizzypopups');
            foreach ($allPopups as $popup) {
                $popups[$popup->ID] = $popup->post_title;
            }
        } else {
            $popups[0] = esc_html__('Create a Popop First', 'fizzypopups');
        }

        return $popups;
    }
}