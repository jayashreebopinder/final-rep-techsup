<?php

namespace Aepro\Modules\AcfFields\Skins;

use Aepro\Modules\AcfFields;
use Aepro\Classes\AcfMaster;
use Aepro\Helper;
use Aepro\Aepro;
use Aepro\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Plugin as EPlugin;

class Skin_Text_Area extends Skin_Text {

	public function get_id() {
		return 'text-area';
	}

	public function get_title() {
		return __( 'Text Area', 'ae-pro' );
	}
    // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function _register_controls_actions() {

		parent::_register_controls_actions();
		remove_action( 'elementor/element/ae-acf/general/after_section_end', [ $this, 'register_fallback' ] );
		remove_action( 'elementor/element/ae-acf/text_general_style/after_section_end', [ $this, 'register_fallback_style' ] );
		add_action( 'elementor/element/ae-acf/general/after_section_end', [ $this, 'add_unfold_section' ] );
		add_action( 'elementor/element/ae-acf/general/after_section_end', [ $this, 'register_fallback' ] );
		add_action( 'elementor/element/ae-acf/general/after_section_end', [ $this, 'manage_controls' ] );
		add_action( 'elementor/element/ae-acf/text_area_section_unfold_style/after_section_end', [ $this, 'register_fallback_style' ] );
	}

	public function manage_controls() {

		$this->remove_control( 'prefix' );
		$this->remove_control( 'suffix' );
		$this->remove_control( 'links_to' );
	}

	public function register_style_controls() {
		parent::register_style_controls(); // TODO: Change the autogenerated stub

		$helper = new Helper();

		$this->start_controls_section(
			'section_unfold_style',
			[
				'label'     => __( 'Unfold', 'ae-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					$this->get_control_id( 'enable_unfold' ) => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'unfold_max_height',
			[
				'label'     => __( 'Max Height', 'ae-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'default'   => [
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-acf-wrapper.ae-acf-unfold-yes' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'unfold_color',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold' => 'background-image: linear-gradient(to bottom, transparent, {{VALUE}});',
				],
			]
		);

		$this->add_control(
			'unfold_button_settings_heading',
			[
				'label'     => __( 'Button', 'ae-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'unfold_button_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .ae-acf-wrapper .ae-acf-unfold',
			]
		);

		$this->start_controls_tabs( 'tabs_button_styles' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'ae-pro' ),
			]
		);

		$this->add_control(
			'unfold_button_color',
			[
				'label'     => __( 'Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'unfold_button_bg_color',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'unfold_icon_color',
			[
				'label'     => __( 'Icon Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold-button-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$helper->box_model_controls(
			$this,
			[
				'name'          => 'unfold_button_style',
				'label'         => __( 'Button', 'ae-pro' ),
				'border'        => true,
				'border-radius' => true,
				'margin'        => true,
				'padding'       => true,
				'box-shadow'    => true,
				'selector'      => '{{WRAPPER}} .ae-acf-unfold-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'ae-pro' ),
			]
		);

		$this->add_control(
			'unfold_button_color_hover',
			[
				'label'     => __( 'Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'unfold_button_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'unfold_icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-acf-unfold-link:hover .ae-acf-unfold-button-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$helper->box_model_controls(
			$this,
			[
				'name'          => 'unfold_button_style_hover',
				'label'         => __( 'Button', 'ae-pro' ),
				'border'        => false,
				'border-radius' => true,
				'margin'        => false,
				'padding'       => false,
				'box-shadow'    => true,
				'selector'      => '{{WRAPPER}} .ae-acf-unfold-link:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render() {

		$settings = $this->parent->get_settings();

		$field_args = [
			'field_type'   => $settings['field_type'],
			'is_sub_field' => $settings['is_sub_field'],
		];

		$accepted_parent_fields = array('repeater', 'group', 'flexible');

        if(in_array ( $settings['is_sub_field'], $accepted_parent_fields )){
			switch($settings['is_sub_field']){

				case 'flexible':	$field_args['field_name'] = $settings['flex_sub_field'];
									$field_args['flexible_field'] = $settings['flexible_field'];
									break;

				case 'repeater':	$field_args['field_name'] = $settings['repeater_sub_field'];
									$field_args['parent_field'] = $settings['repeater_field'];
									break;

				case 'group':		$field_args['field_name'] = $settings['field_name'];
									$field_args['parent_field'] = $settings['parent_field'];
									break;
			}
		}else{
			$field_args['field_name'] = $settings['field_name'];
		}

		$placeholder = $this->get_instance_value( 'placeholder' );
		$unfold      = $this->get_instance_value( 'enable_unfold' );

		$text = AcfMaster::instance()->get_field_value( $field_args );
		if(EPlugin::$instance->editor->is_edit_mode()){
			if($this->get_instance_value('preview_fallback') == 'yes'){
				$this->render_fallback_content($settings);	
			}
		}
		if($text == '' && $placeholder == ''){
			if($this->get_instance_value('enable_fallback') != 'yes'){
				return;
			}else{
				$this->render_fallback_content($settings);
				return;	
			}
		}

		if ( ( $text === '' || is_null( $text ) ) && ( $placeholder !== '' && ! is_null( $placeholder ) ) ) {
			$text   = $placeholder;
			$unfold = '';
		}

		$html_tag = $this->get_instance_value( 'html_tag' );

		$this->parent->add_render_attribute( 'title-class', 'class', 'ae-acf-content-wrapper' );
		$this->parent->add_render_attribute( 'wrapper-class', 'class', 'ae-acf-wrapper' );
		$this->parent->add_render_attribute( 'wrapper-class', 'class', 'ae-acf-unfold-' . $settings[ $this->get_control_id( 'enable_unfold' ) ] );
		
		if($this->get_instance_value('strip_text') == 'yes' ){
			$strip_mode = 	$this->get_instance_value('strip_mode');
			$strip_size = 	$this->get_instance_value('strip_size');
			$strip_append = $this->get_instance_value('strip_append');
				if ( $strip_mode == 'word' ) {
					$text = wp_trim_words( $text, $strip_size, $strip_append );
				} else {
					$text = Aepro::$_helper->ae_trim_letters( $text, 0, $strip_size, $strip_append, false );
				}
		}

		// Process Content
		$text = $this->process_content( $text );

		if ( $text === '' ) {
			$this->parent->add_render_attribute( 'wrapper-class', 'class', 'ae-hide' );
		}
		?>
		<div <?php echo $this->parent->get_render_attribute_string( 'wrapper-class' ); ?>>
			<?php
			echo sprintf( '<%1$s itemprop="name" %2$s>%3$s</%1$s>', esc_html( $html_tag ), $this->parent->get_render_attribute_string( 'title-class' ), $text );

			if ( $unfold === 'yes' ) {
				$this->getFoldUnfoldButtonHtml();
			}

			?>
		</div>
		<?php
	}

	public function getFoldUnfoldButtonHtml() {

		$max_height              = $this->get_instance_value( 'unfold_max_height' );
		$unfold_text             = $this->get_instance_value( 'unfold_text' );
		$unfold_icon             = $this->get_instance_value( 'unfold_icon' );
		$fold_text               = $this->get_instance_value( 'fold_text' );
		$fold_icon               = $this->get_instance_value( 'fold_icon' );
		$animation_speed         = $this->get_instance_value( 'unfold_animation_speed' );
		$auto_hide_unfold_button = $this->get_instance_value( 'auto_hide_unfold_button' );

		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'class', [ 'ae-acf-unfold', 'fold' ] );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-unfold-max-height', $max_height['size'] );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-unfold-text', $unfold_text );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-unfold-icon', $unfold_icon );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-fold-text', $fold_text );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-fold-icon', $fold_icon );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-animation-speed', $animation_speed['size'] );
		$this->parent->add_render_attribute( 'post-acf-unfold-class', 'data-auto-hide-unfold', $auto_hide_unfold_button );

		?>

		<p <?php echo $this->parent->get_render_attribute_string( 'post-acf-unfold-class' ); ?>>
			<span class="ae-acf-unfold-link" href="#">
				<?php if ( $this->get_instance_value( 'unfold_icon' ) ) { ?>
				<span class="ae-acf-unfold-button-icon elementor-align-icon-<?php echo $this->get_instance_value( 'button_icon_position' ); ?>"><i class="<?php echo $this->get_instance_value( 'unfold_icon' ); ?>"></i></span>
				<?php } ?>
				<span class="ae-acf-unfold-button-text"><?php echo $this->get_instance_value( 'unfold_text' ); ?></span>
			</span>
		</p>
		<?php
	}

}
