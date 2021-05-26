<?php

namespace NinjaPopup\Views;
use NinjaPopup\Views\View;
use NinjaPopup\Model\Popup;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Public App Renderer and Handler
 * @since 1.0.0
 */
class FrontendApp
{
    private $popupId;

    public function renderPopup($popupId)
    {
        if ( is_admin() ) {
			return;
		}

        $this->popupId = $popupId;
        $popupConfigs    = get_post_meta($popupId, '_ninja_popup_configs', true);

        if(!$popupConfigs) {
            return __('No data is available', 'ninjayoutubefeed');
        }

        wp_enqueue_style('ninjapopup_app', NINJAPOPUP_URL . 'public/css/popup.css', array(), NINJAPOPUP_VERSION);

        $generatedCss = $this->generateCSS( $popupConfigs );
        update_post_meta($popupId, '_ninja_popup_css', $generatedCss);

        add_action('wp_footer', function () use ($generatedCss) {
            echo "<style id='wp_pricing_css'>". $generatedCss ."</style>";
        });

        wp_enqueue_script('ninja_popup_manager', NINJAPOPUP_URL . 'public/js/popup_manager.js', array('jquery'), NINJAPOPUP_VERSION, true);

        $popupHtml = $this->popupHtml( $popupConfigs );
        return $popupHtml;
    }

    public function popupHtml($popupConfigs)
    {
        $components = $popupConfigs['popup_components'];

        $popupHtml = '';
        // if ($popupHtml = get_post_meta($this->popupId, '_ninja_popup_html', true)) {
        //     return $popupHtml;
        // }

        $bannerIndex = array_search('banner', array_column($components, 'key'));
        $componentWrapperClass = ($bannerIndex !== false && ($components[$bannerIndex]['position'] === 'top' || $components[$bannerIndex]['position'] === 'bottom')) ? 'ninja-popup-components-wrapper-column' : '';
        ob_start();
        ?>
        <div class="nfd-container">
            <div class="nfd-row <?php echo esc_html($popupConfigs['layout_type']); ?>">
                <div class="ninja-popup-modal frontend-popup-modal"  id="ninja-popup-modal-light">
                    <div class="ninja-popup-modal-content" style="background-image:url(<?php echo esc_url($popupConfigs['layout']['background_image_url']); ?>)">
                    <div class="ninja-popup-component-container">
                        <div class="ninja-popup-close-button-container">
                            <div class="ninja-countdown-timer-bar-close" id="close_ninja_popup"></div>
                        </div>
                    </div>  
                    <div class="ninja-popup-components-wrapper <?php echo esc_html($componentWrapperClass); ?>">
                            <?php if($bannerIndex !== false && ($components[$bannerIndex]['position'] === 'left' || $components[$bannerIndex]['position'] === 'top')): ?>
                                <div class="ninja-popup-banner-container">
                                    <div class="ninja-banner-component <?php echo esc_html($components[$bannerIndex]['selector']); ?>" style="background-image:url(<?php echo esc_url($components[$bannerIndex]['image_url']);?>"></div>
                                </div>
                            <?php endif; ?>
                            <div class="ninja-popup-components-container">
                                <?php
                                    foreach($components as $index => $component):
                                    $componentKey = $component['key'];
                                    if( $componentKey === 'banner' ) continue;
                                ?>
                                    <div class="ninja-popup-component-container">
                                        <?php echo $this->getPopupComponentHTML($componentKey, $component); ?>
                                    </div>
                                <?php 
                                    endforeach;
                                ?>
                            </div>
                            <?php if($bannerIndex !== false && ($components[$bannerIndex]['position'] === 'right' || $components[$bannerIndex]['position'] === 'bottom')): ?>
                                <div class="ninja-popup-banner-container">
                                    <div class="ninja-banner-component <?php echo esc_html($components[$bannerIndex]['selector']); ?>" style="background-image:url(<?php echo esc_url($components[$bannerIndex]['image_url']);?>"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $popup = ob_get_clean();
        update_post_meta($this->popupId, '_ninja_popup_html', $popup);
        return $popup;
    }

    public static function getPopupComponentHTML($componentKey, $component)
    {
        $componentName = 'Component'.ucfirst($componentKey);
        return View::make('Frontend.Elements.'.$componentName, $component);
    }

    public function generateCSS($popupConfigs)
    {
        $generatedCss = '';
        // if ($generatedCss = get_post_meta($this->popupId, '_ninja_popup_css', true)) {
        //     return $generatedCss;
        // }

        foreach( $popupConfigs['popup_components'] as $component) {
            $componentKey = $component['key'];
            $componentName = '_component_'.$componentKey;
            $generatedCss .= View::make('Frontend.Css.'.$componentName, [
                'element' => $component,
                'prefix'   => 'ninja-popup-components-container'
            ]);
        }

        $compressed = str_replace('; ', ';', str_replace(' }', '}', str_replace('{ ', '{',
            str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), "",
                preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $generatedCss)))));
        
        update_post_meta($this->popupId, '_ninja_popup_css', $compressed);
        return $compressed;
    }
}
