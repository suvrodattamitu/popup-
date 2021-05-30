<?php

namespace NinjaPopups\Model;

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
        $asset_url = NINJAPOPUPS_URL . 'public';
        return array(
            'christmas_sale' => array(
                'title' => 'Christmas Sale',
                'image'      => $asset_url.'/images/popups/layout-one.png',
                'layout_type'   => 'Christmas Sale',
                'popup_components' => array(
                    array(
                        'key' => 'spacing',
                        'selector'  => 'ninja-popup-spacing1',
                        'size' => 20,
                    ),
                    array(
                        'key' => 'image',
                        'selector'  => 'ninja-popup-image1',
                        'image_url' => $asset_url.'/images/popups/gift-box.png',
                        'scale' => 25,
                    ),
                    array(
                        'key' => 'title',
                        'value' => 'BEST CHRISTMAS GIFTS',
                        'selector'  => 'ninja-popup-title1',
                        'text_color' => '#fff',
                        'text_size'  => 28,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'value' => '50% Off For All',
                        'selector'  => 'ninja-popup-title2',
                        'text_color' => '#fff',
                        'text_size'  => 14,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'button',
                        'text' => 'START SHOPPING',
                        'selector'  => 'ninja-popup-button1',
                        'background_color' => '#E53B10',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    )
                ),
                'layout' => array(
                    'width' => 600,
                    'corners' => 'square',
                    'background_image_url'  => $asset_url.'/images/popups/christmas-sale.png',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#fff'
                ),
                'settings'  => array(
                    'display_time' => 30
                )
            ),

            'discount_offer' => array(
                'title' => 'Discount Offer',
                'image'      => $asset_url.'/images/popups/layout-two.png',
                'layout_type'   => 'Discount Offer',
                'popup_components' => array(
                    array(
                        'key' => 'title',
                        'value' => '2 DAYS ONLY',
                        'selector'  => 'ninja-popup-title1',
                        'text_color' => '#000',
                        'text_size'  => 42,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'value' => 'Get exclusive 10% discount',
                        'selector'  => 'ninja-popup-title2',
                        'text_color' => '#000',
                        'text_size'  => 20,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'separator',
                        'selector'  => 'ninja-popup-separator1',
                        'margin' => 4,
                        'color' => '#000'
                    ),
                    array(
                        'key' => 'button',
                        'text' => 'Yes, I want 10%!!',
                        'selector'  => 'ninja-popup-button1',
                        'background_color' => '#E53B10',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    ),
                    array(
                        'key' => 'banner',
                        'selector'  => 'ninja-popup-banner1',
                        'image_url' => $asset_url.'/images/popups/sale-offer.png',
                        'position' => 'right',
                    )
                ),
                'layout' => array(
                    'width' => 600,
                    'corners' => 'rounded',
                    'background_image_url'  => '',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#000'
                ),
                'settings'  => array(
                    'display_time' => 30
                )
            ),

            'special_offer' => array(
                'title' => 'Special Offer',
                'image'      => $asset_url.'/images/popups/layout-three.png',
                'layout_type'   => 'Special Offer',
                'popup_components' => array(
                    array(
                        'key' => 'image',
                        'selector'  => 'ninja-popup-image1',
                        'image_url' => $asset_url.'/images/popups/super-sale.png',
                        'scale' => 30,
                    ),
                    array(
                        'key' => 'title',
                        'value' => 'A special discount for you',
                        'selector'  => 'ninja-popup-title1',
                        'text_color' => '#000',
                        'text_size'  => 42,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'value' => '50% Off on all of our products ',
                        'selector'  => 'ninja-popup-title2',
                        'text_color' => '#000',
                        'text_size'  => 20,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'button',
                        'text' => 'START SHOPPING',
                        'selector'  => 'ninja-popup-button1',
                        'background_color' => '#A8E510',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    )
                ),
                'layout' => array(
                    'width' => 600,
                    'corners' => 'square',
                    'background_image_url'  => '',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#000'
                ),
                'settings'  => array(
                    'display_time' => 30
                )
            )
        );
    }
}