<?php

namespace NinjaPopup\Model;

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
        $asset_url = NINJAPOPUP_URL . 'public';
        return array(
            'template_one' => array(
                'title' => 'Christmas Sale',
                'description' => 'Raise your customer engagement by showing the Christmas Sale Templates',
                'image'      => $asset_url.'/images/popups/one.png',
                'layout_type'   => 'template_one',
                'popup_components' => array(
                    array(
                        'key' => 'image',
                        'selector'  => 'ninja-popup-image1',
                        'image_url' => $asset_url.'/images/popups/christmas-sale.png',
                        'scale' => 50,
                    ),
                    array(
                        'key' => 'spacing',
                        'selector'  => 'ninja-popup-spacing1',
                        'size' => 20,
                    ),
                    array(
                        'key' => 'title',
                        'value' => 'Christmas Sale!',
                        'selector'  => 'ninja-popup-title1',
                        'text_color' => '#fff',
                        'text_size'  => 28,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'value' => 'Christmas Sale!',
                        'selector'  => 'ninja-popup-title2',
                        'text_color' => '#fff',
                        'text_size'  => 10,
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
                    'corners' => 'rounded',
                    'background_image_url'  => $asset_url.'/images/popups/christmas-sale.jpeg',
                    'background_image_overlay_color' => '',
                    'background_color'  => '#fff',
                    'display_close_button'  => 'true',
                    'close_button_color' => '#fff'
                ),
                'settings'  => array(
                    'display_time' => 30
                )
            ),

            'template_two' => array(
                'title' => 'Christmas Sale',
                'description' => 'Raise your customer engagement by showing the Christmas Sale Templates',
                'image'      => $asset_url.'/images/popups/one.png',
                'layout_type'   => 'template_two',
                'popup_components' => array(
                    array(
                        'key' => 'title',
                        'value' => '3 DAYS ONLY',
                        'selector'  => 'ninja-popup-title1',
                        'text_color' => '#000',
                        'text_size'  => 42,
                        'text_weight' => 'bold'
                    ),
                    array(
                        'key' => 'title',
                        'value' => 'You can get an exclusive discount 15%',
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
                        'text' => 'START SHOPPING',
                        'selector'  => 'ninja-popup-button1',
                        'background_color' => '#A8E510',
                        'text_color' => '#fff',
                        'size'  => 12,
                        'width' => 337
                    ),
                    array(
                        'key' => 'banner',
                        'selector'  => 'ninja-popup-banner1',
                        'image_url' => $asset_url.'/images/popups/offer.jpeg',
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
            )
        );
    }
}