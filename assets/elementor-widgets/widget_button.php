<?php

namespace BusyBytes\ElementorWidgets;

use Elementor\Widget_Button;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button extends Widget_Button {
	
    public function bb_button_get_button_classes() {
        $classes = array(
            '' => 'Default',
            'primary' => 'Primary',
			'secondary' => 'Secondary',
		);
		$classes = apply_filters( 'bb_button_get_button_classes', $classes );
		return $classes;
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {
		parent::_register_controls();
		
		$this->remove_control('button_type');
		
        $this->start_controls_section(
			'bb_section', array( 'label' => 'BusyBytes Extension' )
		);
		
		$this->add_control(
			'bb_button_class',
			array(
				'label' => __( 'Button Class', 'bb-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => self::bb_button_get_button_classes(),
				'description' => 'To adapt these classes, read the documentation!'
			)
        );

		$this->end_controls_section();
	}
	
	protected function render() {

        // wrap with new class, we can select it via css
		$settings = $this->get_settings();

		// if the button_class is empty,
		// render without wrapper and return
		if ( empty( $settings['bb_button_class'] ) ) {
			parent::render();
			return;
		}

		?>
			<div class="btn <?php echo 'btn-' . $settings['bb_button_class']; ?>">
				<?php parent::render(); ?>
			</div>
		<?php
	}

	protected function _content_template() {
		?>
			<div class="btn btn-{{{ settings.bb_button_class }}}">
				<?php parent::_content_template(); ?>
			</div>
		<?php
	}
}