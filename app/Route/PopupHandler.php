<?php

namespace FizzyPopups\Route;
use FizzyPopups\Model\Popup;

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
        add_action('wp_ajax_fizzy_popup_admin_ajax', array($this, 'handeEndPoint'));
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
            'bulk_action'   => 'bulkAction',
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
            'message' => __(' Title successfully updated', 'fizzypopups')
        ), 200);
    }

    public function getallPopups()
    {
        $perPage = intval($_REQUEST['per_page']);
        $pageNumber = intval($_REQUEST['page_number']);
        $searchString = sanitize_text_field($_REQUEST['search_string']);
        $OFFSET = ($pageNumber-1)*$perPage;

        $postType = 'fizzy_popup';
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
        delete_post_meta($popupId, '_fizzy_popup_configs', true);
        delete_post_meta($popupId, '_fizzy_popup_html', true);
        wp_send_json_success([
            'message' => __('Popup deleted successfully', 'fizzypopups'),
        ], 200);
    }

    public function bulkAction()
    {
        $bulkValue =  sanitize_text_field($_REQUEST['bulk_value']);
        $popupIds = sanitize_text_field($_REQUEST['popup_ids']);
        $popupIds = json_decode(wp_unslash($popupIds), true);
        $popupIds = array_filter(array_column($popupIds, 'ID'));

        if( $bulkValue === 'delete' ) {
            foreach($popupIds as $popupId) {
                wp_delete_post($popupId, true);
                delete_post_meta($popupId, '_fizzy_popup_configs', true);
                delete_post_meta($popupId, '_fizzy_popup_html', true);
            }
        }

        wp_send_json_success([
            'message' => __("Data ${bulkValue} successfully", 'fizzypopups')
        ], 200);
    }

    public function duplicatePopup()
    {
        $oldPopupId = intval($_REQUEST['popup_id']);
        $oldPopup = get_post($oldPopupId, 'ARRAY_A');

        $newPopupId = wp_insert_post([
            'post_title'    => '(Duplicate) ' .$oldPopup['post_title'],
            'post_content'  => $oldPopup['post_content'],
            'post_type'     => 'fizzy_popup',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id()
        ]);

        $oldPopupMeta = get_post_meta($oldPopupId, '_fizzy_popup_configs', true);

        if ($oldPopupMeta) {
            update_post_meta($newPopupId, '_fizzy_popup_configs', $oldPopupMeta);
        }

        wp_send_json_success([
            'message' => __('Popup successfully duplicated', 'fizzypopups'),
            'popup_id' => $newPopupId
        ], 200);
    }

    public function createPopupMeta()
    {
        $predefined = sanitize_text_field($_REQUEST['type']);
        $popups = (new Popup())->predefinedPopups();

        if ( isset($popups[$predefined]) ) {
            $predefinedTemplate = $popups[$predefined];
            $templateData = array(
                'post_title' => $predefinedTemplate['title'],
                'post_content' => $predefinedTemplate['layout_type'],
                'post_type' => 'fizzy_popup',
                'post_status' => 'publish'
            );

            $templateId = wp_insert_post($templateData);
            update_post_meta($templateId, '_fizzy_popup_configs', $predefinedTemplate );
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
                'message' => __('Template Successfully created', 'fizzypopups'),
                'template_id' => $templateId
            ), 200);
        }

        wp_send_json_error([
            'message' => __("The selected template couldn't be found.", 'fizzypopups')
        ], 423);
    }

    public function getPopupMeta()
    {
        $popupId = intval($_REQUEST['popup_id']);
        $popupDetails = get_post($popupId);
        $popupMeta    = get_post_meta($popupId, '_fizzy_popup_configs', true);

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
        $popupMeta = $_REQUEST['popup_meta'];

        $metaData = sanitize_text_field($popupMeta);
        $metaData = json_decode(wp_unslash($metaData),true);
        
        //for sanitizing html input field
        $popupMeta = json_decode(wp_unslash($popupMeta),true);
        $components = $popupMeta['popup_components'];
        foreach($components as $index=>$component) {
            $key = sanitize_text_field($component['key']);
            $componentData = '';
            if( $key === 'html' ) {
                $componentData = wp_kses_post($component[$key]);
                $selector  = sanitize_text_field($component['selector']);
                $metaData['popup_components'][$index]['key'] = $key;
                $metaData['popup_components'][$index][$key] = $componentData;
                $metaData['popup_components'][$index]['selector'] = $selector;
            } 
        }

        update_post_meta($popupId, '_fizzy_popup_configs', $metaData);

        do_action('fizzy_popup_meta_updated', $popupId, $metaData);

        wp_send_json_success([
            'message'   => __('Congrats, successfully saved!', 'fizzypopups'),
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
        delete_post_meta($popupId, '_fizzy_popup_html', false);
        delete_post_meta($popupId, '_fizzy_popup_css', false);
    }
}