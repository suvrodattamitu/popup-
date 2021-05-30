<?php

namespace NinjaPopups\Route;
use NinjaPopups\Model\Popup;

if (!defined('ABSPATH')) {
    exit;
}

class PopupHandler
{
    /**
     *
     * Register Urls
     *
     * @since 1.0.0
     *
     **/
    public function registerEndpoints()
    {
        add_action('wp_ajax_ninja_popup_admin_ajax', array($this, 'handeEndPoint'));
    }

    /**
     *
     * validate routes
     *
     * @return method name
     * @since 1.0.0
     *
     **/
    public function handeEndPoint()
    {
        $route = sanitize_text_field($_REQUEST['route']);
        $routes = array(
            //popup title
            'update_popup_title' => 'updatePopupTitle',

            //predefined meta
            'get_predefined_template' => 'all',

            //popup meta
            'create_popup_meta'   => 'createPopupMeta',
            'get_popup_meta'     => 'getPopupMeta',
            'update_popup_meta'  => 'updatePopupMeta',

            //all popups
            'get_all_popups' => 'getallPopups',
            'delete_popup'   => 'deletePopup',
            'duplicate_popup'=> 'duplicatePopup',
        );

        if (isset($routes[$route])) {
            return $this->{$routes[$route]}();
        }
    }

    public function updatePopupTitle()
    {
        $popupId = intval($_REQUEST['popup_id']);
        $popupTitle = sanitize_text_field($_REQUEST['popup_title']);
        $data = array(
            'ID' => $popupId,
            'post_title' => $popupTitle
        );
        wp_update_post($data);
        wp_send_json_success(array(
            'message' => __(' Title successfully updated', 'ninjapopups')
        ), 200);
    }

    public function getallPopups()
    {
        $perPage = intval($_REQUEST['per_page']);
        $pageNumber = intval($_REQUEST['page_number']);
        $searchString = sanitize_text_field($_REQUEST['search_string']);
        $OFFSET = ($pageNumber-1)*$perPage;

        $postType = 'ninja_popup';
        $postStatus = 'publish';

        global $wpdb;
        $table_name = $wpdb->prefix . "posts";

        $totalPopups = count($wpdb->get_results("SELECT * FROM $table_name WHERE post_type='$postType' AND post_status='$postStatus' AND ( post_title LIKE '%$searchString%' OR post_content LIKE '%$searchString%' )"));
        $allPopups = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type='$postType' AND post_status='$postStatus' AND ( post_title LIKE '%$searchString%' OR post_content LIKE '%$searchString%' )  ORDER BY ID DESC LIMIT $perPage OFFSET $OFFSET ");

        wp_send_json_success([
            'allPopups'  => $allPopups,
            'total'     => $totalPopups
        ], 200);
    }

    public function deletePopup()
    {
        $popupId = intval($_REQUEST['popup_id']);
        wp_delete_post($popupId, true);
        delete_post_meta($popupId, '_ninja_popup_configs', true);
        delete_post_meta($popupId, '_ninja_popup_html', true);
        wp_send_json_success([
            'message' => __('Popup deleted successfully', 'ninjapopups'),
        ], 200);
    }

    public function duplicatePopup()
    {
        $oldPopupId = intval($_REQUEST['popup_id']);
        $oldPopup = get_post($oldPopupId, 'ARRAY_A');

        $newPopupId = wp_insert_post([
            'post_title'    => '(Duplicate) ' .$oldPopup['post_title'],
            'post_content'  => $oldPopup['post_content'],
            'post_type'     => 'ninja_popup',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id()
        ]);

        $oldPopupMeta = get_post_meta($oldPopupId, '_ninja_popup_configs', true);

        if ($oldPopupMeta) {
            update_post_meta($newPopupId, '_ninja_popup_configs', $oldPopupMeta);
        }

        wp_send_json_success([
            'message' => __('Popup successfully duplicated', 'ninjapopups'),
            'popup_id' => $newPopupId
        ], 200);
    }

    public function createPopupMeta()
    {
        $predefined = $_REQUEST['type'];

        $popups = (new Popup())->predefinedPopups();

        if ( isset($popups[$predefined]) ) {

            $predefinedTemplate = $popups[$predefined];

            //$predefinedTemplateMeta = json_decode($predefinedTemplate['json'], true);

            //create new post and meta
            $templateData = array(
                'post_title' => $predefinedTemplate['title'],
                'post_content' => $predefinedTemplate['layout_type'],
                'post_type' => 'ninja_popup',
                'post_status' => 'publish'
            );

            $templateId = wp_insert_post($templateData);

            update_post_meta($templateId, '_ninja_popup_configs', $predefinedTemplate );

            wp_update_post([
                'ID' => $templateId,
                'post_title' => $predefinedTemplate['title'] . ' (#' . $templateId . ')'
            ]);

            if (is_wp_error($templateId)) {
                wp_send_json_error(array(
                    'message' => $templateId->get_error_message()
                ), 423);
            }

            wp_send_json_success(array(
                'message' => __('Template Successfully created', 'ninjapopups'),
                'template_id' => $templateId
            ), 200);
        }

        wp_send_json_error([
            'message' => __("The selected template couldn't be found.", 'ninjapopups')
        ], 423);
    }

    public function getPopupMeta()
    {
        $popupId = intval($_REQUEST['popup_id']);
        $popupDetails = get_post($popupId);
        $popupMeta    = get_post_meta($popupId, '_ninja_popup_configs', true);

        $popupMeta = (new Popup())->predefinedPopups();
        $popupMeta = $popupMeta['christmas_sale'];

        wp_send_json_success([
            'message' => 'success',
            'popup_id' => $popupId,
            'popup_details' => $popupDetails,
            'popup_meta' => $popupMeta,
        ], 200);
    }

    public function updatePopupMeta() 
    {
        $popupId = intval($_REQUEST['popup_id']);
        $popupMeta = wp_unslash($_REQUEST['popup_meta']);
        $popupMeta = json_decode($popupMeta, true);
        update_post_meta($popupId, '_ninja_popup_configs', $popupMeta);

        do_action('ninja_popup_meta_updated', $popupId, $popupMeta);

        wp_send_json_success([
            'message'   => __('Congrats, successfully saved!', 'ninjapopups'),
        ], 200);
    }

    public function all()
    {
        $data = array();
        $predefinedPopups = (new Popup())->predefinedPopups();
        foreach ($predefinedPopups as $key => $item) {
            $data[$key] = array(
                'title'      => $item['title'],
                'layout_type'=> $item['layout_type'],
                'image'      => $item['image'],
            );
        }
        wp_send_json_success([
            'templates'=>$data
        ], 200);
    }

    public static function deleteCache($popupId) {
        delete_post_meta($popupId, '_ninja_popup_html', false);
        delete_post_meta($popupId, '_ninja_popup_css', false);
    }
}