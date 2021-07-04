<?php 

namespace FizzyPopups\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use Elementor\Group_Control_Background;
use \Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) 
exit; // Exit if accessed directly

class PopupWidget extends Widget_Base {
    public function get_name() 
    {
        return 'fizzy-popups';
    }

    public function get_title() 
    {
        return __( 'Fizzy Popups', 'fizzypopups' );
    }

    public function get_icon() 
    {
        return 'eicon-form-horizontal';
    }
	
	public function get_categories() {
        return ['general'];
    }

    public function get_keywords() 
    {
        return [
            'popup',
            'fizzypopup',
            'fizzy popup',
            'fizzy popups',
            'popups',
            'elementor popups',
        ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_fizzy_popup',
            [
                'label' => __('Fizzy Popups', 'fizzypopups'),
            ]
        );


        $this->add_control(
            'popup_id',
            [
                'label' => esc_html__('Fizzy Popups', 'fizzypopups'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ElementorHelper::getPopups(),
                'default' => '0',
            ]
        );

        $this->end_controls_section();
    }

    public function is_reload_preview_required() {
		return true;
	}

    protected function render() 
    {
        $settings = $this->get_settings_for_display();
        extract($settings);
        if ( ! empty( $popup_id ) ) { 
            echo do_shortcode('[fizzy_popup_layout id="' . $popup_id . '"]');
        }        
    }

	protected function content_template() {}
}