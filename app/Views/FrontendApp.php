<?php

namespace FizzyPopups\Views;
use FizzyPopups\Views\View;
use FizzyPopups\Model\Popup;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render Popup
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
        $popupConfigs    = get_post_meta($popupId, '_fizzy_popup_configs', true);

        if(!$popupConfigs) {
            return __('No data is available', 'fizzyyoutubefeed');
        }

        wp_enqueue_style('fizzypopups_app', FIZZYPOPUPS_URL . 'public/css/popup.css', array(), FIZZYPOPUPS_VERSION);

        $generatedCss = $this->generateCSS( $popupConfigs );
        update_post_meta($popupId, '_fizzy_popup_css', $generatedCss);

        add_action('wp_footer', function () use ($generatedCss) {
            echo "<style id='fizzy_popup_css'>". $generatedCss ."</style>";
        });

        wp_enqueue_script('fizzy_popup_manager', FIZZYPOPUPS_URL . 'public/js/popup_manager.js', array('jquery'), FIZZYPOPUPS_VERSION, true);

        $popupHtml = $this->popupHtml( $popupConfigs );
        return $popupHtml;
    }

    public function popupHtml($popupConfigs)
    {
        $components = $popupConfigs['popup_components'];

        $popupHtml = '';
        if ($popupHtml = get_post_meta($this->popupId, '_fizzy_popup_html', true)) {
            return $popupHtml;
        }

        $bannerIndex = array_search('banner', array_column($components, 'key'));
        $componentWrapperClass = ($bannerIndex !== false && $components[$bannerIndex]['show'] === 'true' && ($components[$bannerIndex]['position'] === 'top' || $components[$bannerIndex]['position'] === 'bottom')) ? 'fizzy-popup-components-wrapper-column' : '';
        ob_start();
        ?>
        <div class="nfd-container">
            <div class="nfd-row <?php echo esc_html($popupConfigs['layout_type']); ?>">
                <div class="fizzy-popup-modal frontend-popup-modal"  id="fizzy-popup-modal-light">
                    <div class="fizzy-popup-modal-content fizzy-popup-content-styler">
                    <?php if($popupConfigs['layout']['display_close_button'] === 'true'): ?>
                    <div class="fizzy-popup-component-container">
                        <div class="fizzy-popup-close-button-container">
                            <div class="fizzy-countdown-timer-bar-close" id="close_fizzy_popup" style="color:<?php echo esc_html($popupConfigs['layout']['close_button_color']); ?>"></div>
                        </div>
                    </div>  
                    <?php endif; ?>
                    <div class="fizzy-popup-components-wrapper <?php echo esc_html($componentWrapperClass); ?>">
                            <?php if($bannerIndex !== false && $components[$bannerIndex]['show'] === 'true' && ($components[$bannerIndex]['position'] === 'left' || $components[$bannerIndex]['position'] === 'top')): ?>
                                <div class="fizzy-popup-banner-container">
                                    <div class="fizzy-banner-component <?php echo esc_html($components[$bannerIndex]['selector']); ?>" style="background-image:url(<?php echo esc_url($components[$bannerIndex]['image_url']);?>"></div>
                                </div>
                            <?php endif; ?>
                            <div class="fizzy-popup-components-container">
                                <?php
                                    foreach($components as $index => $component):
                                    $componentKey = $component['key'];
                                    if( $componentKey === 'banner' || $component['show'] === 'false') continue;
                                ?>
                                    <div class="fizzy-popup-component-container">
                                        <?php echo $this->getPopupComponentHTML($componentKey, $component); ?>
                                    </div>
                                <?php 
                                    endforeach;
                                ?>
                            </div>
                            <?php if($bannerIndex !== false && $components[$bannerIndex]['show'] === 'true' && ($components[$bannerIndex]['position'] === 'right' || $components[$bannerIndex]['position'] === 'bottom')): ?>
                                <div class="fizzy-popup-banner-container">
                                    <div class="fizzy-banner-component <?php echo esc_html($components[$bannerIndex]['selector']); ?>" style="background-image:url(<?php echo esc_url($components[$bannerIndex]['image_url']);?>"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $popup = ob_get_clean();
        update_post_meta($this->popupId, '_fizzy_popup_html', $popup);
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
        if ($generatedCss = get_post_meta($this->popupId, '_fizzy_popup_css', true)) {
            return $generatedCss;
        }

        foreach( $popupConfigs['popup_components'] as $component) {
            if( $component['show'] === 'false' ) continue;
            $componentKey = $component['key'];
            $componentName = '_component_'.$componentKey;
            $generatedCss .= View::make('Frontend.Css.'.$componentName, [
                'element' => $component,
                'prefix'   => 'fizzy-popup-components-container'
            ]);
        }

        $generatedCss .= View::make('Frontend.Css.popup', [
            'popup_meta' => $popupConfigs,
        ]);

        $compressed = str_replace('; ', ';', str_replace(' }', '}', str_replace('{ ', '{',
            str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), "",
                preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $generatedCss)))));
        
        update_post_meta($this->popupId, '_fizzy_popup_css', $compressed);
        return $compressed;
    }
}