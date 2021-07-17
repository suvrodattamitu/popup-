<?php

namespace FizzyPopups\Model;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Base Model Class
 * @since 1.0.0
*/
class Popup
{
    public function predefinedPopups()
    {
        $asset_url = FIZZYPOPUPS_URL . 'public';
        return array(
            'christmas_sale' => array(
                'title' => 'Christmas Sale',
                'image'      => $asset_url.'/images/popups/layout-one.png',
                'layout_type'   => 'Christmas Sale',
                'is_pro'    => false,
                'popup_components' => array(
                    array(
                        'key' => 'spacing',
                        'show' => 'true',
                        'selector'  => 'fizzy-popup-spacing1',
                        'size' => 20,
                    ),
                    array(
                        'key' => 'image',
                        'show' => 'true',
                        'selector'  => 'fizzy-popup-image1',
                        'image_url' => $asset_url.'/images/popups/gift-box.png',
                        'scale' => 25,
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => 'BEST CHRISTMAS GIFTS',
                        'selector'  => 'fizzy-popup-title1',
                        'text_color' => '#fff',
                        'text_size'  => 28,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => '50% Off For All',
                        'selector'  => 'fizzy-popup-title2',
                        'text_color' => '#fff',
                        'text_size'  => 14,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'button',
                        'show' => 'true',
                        'btn_url' => 'https://www.google.com',
                        'text' => 'START SHOPPING',
                        'selector'  => 'fizzy-popup-button1',
                        'background_color' => '#E53B10',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    ),
                    array(
                        'key' => 'html',
                        'show' => 'true',
                        'selector'  => '.fizzy-popup-html1',
                        'html' => '',
                    )
                ),
                'layout' => array(
                    'margin' => 15,
                    'width' => 600,
                    'corners' => 'square',
                    'background_image_url'  => $asset_url.'/images/popups/christmas-sale.png',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#fff'
                ),
                'settings'  => array(
                    'trigger_type'  => 'page_load',
                    'display_time'  => 30,
                    'html_element'  => ''
                )
            ),
            'discount_offer' => array(
                'title' => 'Discount Offer',
                'image'      => $asset_url.'/images/popups/layout-two.png',
                'layout_type'   => 'Discount Offer',
                'is_pro'    => false,
                'popup_components' => array(
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => '2 DAYS ONLY',
                        'selector'  => 'fizzy-popup-title1',
                        'text_color' => '#000',
                        'text_size'  => 42,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => 'Get exclusive 70% discount',
                        'selector'  => 'fizzy-popup-title2',
                        'text_color' => '#000',
                        'text_size'  => 20,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'separator',
                        'show' => 'true',
                        'selector'  => 'fizzy-popup-separator1',
                        'margin' => 4,
                        'color' => '#000'
                    ),
                    array(
                        'key' => 'button',
                        'show' => 'true',
                        'btn_url' => 'https://www.google.com',
                        'text' => 'Yes, I want 70%!!',
                        'selector'  => 'fizzy-popup-button1',
                        'background_color' => '#E53B10',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    ),
                    array(
                        'key' => 'banner',
                        'show' => 'true',
                        'selector'  => 'fizzy-popup-banner1',
                        'image_url' => $asset_url.'/images/popups/sale-offer.png',
                        'position' => 'right',
                    ),
                    array(
                        'key' => 'html',
                        'show' => 'true',
                        'selector'  => '.fizzy-popup-html1',
                        'html' => '',
                    )
                ),
                'layout' => array(
                    'margin' => 15,
                    'width' => 600,
                    'corners' => 'rounded',
                    'background_image_url'  => '',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#000'
                ),
                'settings'  => array(
                    'trigger_type'  => 'page_load',
                    'display_time'  => 30,
                    'html_element'  => ''
                )
            ),
            'special_offer' => array(
                'title' => 'Special Offer',
                'image'      => $asset_url.'/images/popups/layout-three.png',
                'layout_type'   => 'Special Offer',
                'is_pro'    => false,
                'popup_components' => array(
                    array(
                        'key' => 'image',
                        'show' => 'true',
                        'selector'  => 'fizzy-popup-image1',
                        'image_url' => $asset_url.'/images/popups/super-sale.png',
                        'scale' => 50,
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => 'A special discount for you',
                        'selector'  => 'fizzy-popup-title1',
                        'text_color' => '#000',
                        'text_size'  => 42,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => '50% off on all of our products ',
                        'selector'  => 'fizzy-popup-title2',
                        'text_color' => '#000',
                        'text_size'  => 20,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'button',
                        'show' => 'true',
                        'btn_url' => 'https://www.google.com',
                        'text' => 'START SHOPPING',
                        'selector'  => 'fizzy-popup-button1',
                        'background_color' => '#A8E510',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    ),
                    array(
                        'key' => 'html',
                        'show' => 'true',
                        'selector'  => '.fizzy-popup-html1',
                        'html' => '',
                    )
                ),
                'layout' => array(
                    'margin' => 15,
                    'width' => 600,
                    'corners' => 'square',
                    'background_image_url'  => '',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#000'
                ),
                'settings'  => array(
                    'trigger_type'  => 'page_load',
                    'display_time'  => 30,
                    'html_element'  => ''
                )
            ),
            'shortcode_popup' => array(
                'title' => 'Shortcode Popup',
                'image'      => $asset_url.'/images/popups/layout-four.png',
                'layout_type'   => 'Shortcode Popup',
                'is_pro'    => true,
                'popup_components' => array(
                    array(
                        'key' => 'shortcode',
                        'show' => 'true',
                        'selector'  => '.fizzy-popup-shortcode1',
                        'shortcode' => '',
                    ),
                ),
                'layout' => array(
                    'margin' => 15,
                    'width' => 600,
                    'corners' => 'square',
                    'background_image_url'  => '',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#000'
                ),
                'settings'  => array(
                    'trigger_type'  => 'page_load',
                    'display_time'  => 30,
                    'html_element'  => ''
                )
            ),
            'blank_popup' => array(
                'title' => 'Blank Popup',
                'image'      => $asset_url.'/images/popups/layout-five.png',
                'layout_type'   => 'Blank Popup',
                'is_pro'    => false,
                'popup_components' => array(
                    array(
                        'key' => 'html',
                        'show' => 'true',
                        'selector'  => '.fizzy-popup-html1',
                        'html' => '',
                    ),
                    array(
                        'key' => 'image',
                        'show' => 'true',
                        'selector'  => 'fizzy-popup-image1',
                        'image_url' => '',
                        'scale' => 20,
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => '',
                        'selector'  => 'fizzy-popup-title1',
                        'text_color' => '#000',
                        'text_size'  => 42,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'show' => 'true',
                        'value' => '',
                        'selector'  => 'fizzy-popup-title2',
                        'text_color' => '#000',
                        'text_size'  => 20,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'button',
                        'show' => 'true',
                        'btn_url' => '',
                        'text' => '',
                        'selector'  => 'fizzy-popup-button1',
                        'background_color' => '#A8E510',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    )
                ),
                'layout' => array(
                    'margin' => 15,
                    'width' => 600,
                    'corners' => 'square',
                    'background_image_url'  => '',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#000'
                ),
                'settings'  => array(
                    'trigger_type'  => 'page_load',
                    'display_time'  => 30,
                    'html_element'  => ''
                )
            )
        );
    }
}