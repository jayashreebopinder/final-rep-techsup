<?php
namespace Aepro\Modules\TaxonomyBlocks\Skins;

use Aepro\Aepro;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Aepro\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Skin_List extends Skin_Base {
	//phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function _register_controls_actions() {
		parent::_register_controls_actions(); // TODO: Change the autogenerated stub
		add_action( 'elementor/element/ae-taxonomy-blocks/section_layout/before_section_end', [ $this, 'register_controls' ] );
		add_action( 'elementor/element/ae-taxonomy-blocks/list_section_title_style/before_section_end', [ $this, 'add_count_style' ] );
		add_action( 'elementor/element/ae-taxonomy-blocks/list_section_title_style/after_section_end', [ $this, 'update_style_controls' ] );
		add_action( 'elementor/element/ae-taxonomy-blocks/list_section_title_style/after_section_end', [ $this, 'update_style_controls' ] );
		add_action( 'elementor/element/ae-taxonomy-blocks/list_section_title_style/after_section_end', [ $this, 'remove_style_controls' ] );
	}

	public function get_id() {
		return 'list';
	}

	public function get_title() {
		return __( 'List', 'ae-pro' );
	}

	public function register_controls( Widget_Base $widget ) {

		$this->parent = $widget;

		$this->list_layout_controls();
		$this->icon_controls();
		$this->title_controls();
		$this->count_controls();
	}

	public function add_count_style(Widget_Base $widget){
		$this->parent = $widget;
		$this->add_control(
			'count_style',
			[
				'label'     => __( 'Count', 'ae-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator'	=>	'before'	
			]
		);

		$this->add_control(
			'title_count_color',
			[
				'label'     => __( 'Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ae-element-term-title .term-posts-count' => 'color: {{VALUE}};',
				],
			]
		);
	}

	public function register_style_controls() {
		parent::register_style_block_controls();
		parent::register_style_list_controls();
		parent::register_style_title_controls();
		parent::register_style_icon_controls();
	}


	public function update_style_controls() {
		$this->update_control(
			'html_tag',
			[
				'default' => 'div',
			]
		);

		
	}

	public function remove_style_controls() {
		$this->remove_control( 'title_align_horizontal' );
		$this->remove_control( 'title_align_vertical' );
		$this->remove_control( 'title_padding' );
		$this->remove_control( 'title_padding_hover' );
	}

	public function render() {
		// TODO: Implement render() method.

		$settings = $this->parent->get_settings_for_display();

		$terms = Aepro::$_helper->ae_taxonomy_terms( $settings['ae_taxonomy'], $settings );
		if(empty($terms)){
			return;
		}
		$taxonomy = get_taxonomy( $settings['ae_taxonomy'] );
		$current_term = $this->ae_get_current_term();
		$this->parent->add_render_attribute( 'term-list-wrapper', 'class', 'ae-term-skin-list' );
		$this->parent->add_render_attribute( 'term-list-wrapper', 'class', 'ae-icon-list-items' );
		if(!is_archive()){
			$this->parent->add_render_attribute( 'term-list-item', 'class', 'ae-icon-list-item ae-term-list-item' );
		}
		
		$this->parent->add_render_attribute( 'term-list-item-inner', 'class', 'ae-term-list-item-inner ae-icon-list-text' );

		if ( 'inline' === $settings[ $this->get_control_id( 'list_layout' ) ] ) {
			$this->parent->add_render_attribute( 'term-list-wrapper', 'class', 'ae-list-horizontal' );
		} else {
			$this->parent->add_render_attribute( 'term-list-wrapper', 'class', 'ae-list-vertical' );
		}

		$this->parent->add_render_attribute( 'taxonomy-widget-wrapper', 'data-pid', get_the_ID() );
		$this->parent->add_render_attribute( 'taxonomy-widget-wrapper', 'data-wid', $this->parent->get_id() );
		$this->parent->add_render_attribute( 'taxonomy-widget-wrapper', 'data-source', $settings['ae_taxonomy'] );
		$this->parent->add_render_attribute( 'taxonomy-widget-wrapper', 'class', 'ae-taxonomy-widget-wrapper' );
		?>
		<div <?php echo $this->parent->get_render_attribute_string( 'taxonomy-widget-wrapper' ); ?>>
			<ul <?php echo $this->parent->get_render_attribute_string( 'term-list-wrapper' ); ?>>
				<?php
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					$count = count( $terms );
					foreach ( $terms as $term ) {
						if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
							if($term->term_id == $current_term){
								$this->parent->set_render_attribute( 'term-list-item', 'class', ['ae-term-active', 'ae-icon-list-item ae-term-list-item', 'ae-term-'.$term->term_id] );
							}else{
								$this->parent->set_render_attribute( 'term-list-item', 'class', ['ae-icon-list-item','ae-term-list-item', 'ae-term-'.$term->term_id]);
							}
						}else{
							if(is_archive()){
								if($term->term_id === $current_term){
									$this->parent->set_render_attribute( 'term-list-item', 'class', ['ae-term-active', 'ae-icon-list-item ae-term-list-item', 'ae-term-'.$term->term_id] );
								}else{
									$this->parent->set_render_attribute( 'term-list-item', 'class', ['ae-icon-list-item','ae-term-list-item','ae-term-'.$term->term_id]);
								}
							}else{
								$this->parent->set_render_attribute( 'term-list-item', 'class', ['ae-icon-list-item','ae-term-list-item', 'ae-term-'.$term->term_id]);
							}
						}
						$this->parent->set_render_attribute( 'term-list-item', 'data-term-id', 'ae-term-'.$term->term_id );
						$this->parent->set_render_attribute( 'term-list-item', 'data-tax-count', $term->count );
						?>
						<li <?php echo $this->parent->get_render_attribute_string( 'term-list-item' ); ?>>
							<div <?php echo $this->parent->get_render_attribute_string( 'term-list-item-inner' ); ?>>
								<?php
								$title_html = '';
								$this->parent->set_render_attribute( 'term-title-wrapper', 'class', 'ae-term-title-wrapper' );
								$title_html .= '<div ' . $this->parent->get_render_attribute_string( 'term-title-wrapper' ) . '>';
								if ( $this->get_instance_value( 'show_title' ) === 'yes' ) {
									$this->parent->set_render_attribute( 'term-title-class', 'class', 'ae-element-term-title' );
									$term_title = $term->name;
									if ( $this->get_instance_value( 'strip_title' ) === 'yes' ) {
										if ( $this->get_instance_value( 'strip_mode' ) === 'word' ) {
											$term_title = wp_trim_words( $term_title, $this->get_instance_value( 'strip_size' ), $this->get_instance_value( 'strip_append' ) );
										} else {
											$term_title = rtrim( substr( $term_title, 0, $this->get_instance_value( 'strip_size' ) ) ) . $this->get_instance_value( 'strip_append' );
										}
									}
									$term_title = '<span class="term-list-text">' . $term_title . '</span>';
									if ( $this->get_instance_value( 'enable_title_link' ) === 'yes' ) {
										if ( $this->get_instance_value( 'title_new_tab' ) === 'yes' ) {
											$this->parent->set_render_attribute( 'term-link-class', 'target', '_blank' );
										}
										$title_html .= '<a ' . $this->parent->get_render_attribute_string( 'term-link-class' ) . ' href="' . esc_url( get_term_link( $term ) ) . '">';
									}
									if ( $this->get_instance_value( 'show_icon' ) === 'yes' ) {
										$term_title = '<span class="term-list-icon"><i class="' . $this->get_instance_value( 'icon' ) . '"></i></span>' . $term_title;
									}
									if ( $this->get_instance_value( 'show_count' ) === 'yes' ) {
										$term_title .= ' <span class="term-posts-count">(' . $term->count . ')</span>';
									}
									$title_html .= sprintf( '<%1$s itemprop="name" %2$s>%3$s</%1$s>', $this->get_instance_value( 'html_tag' ), $this->parent->get_render_attribute_string( 'term-title-class' ), $term_title );

									if ( $this->get_instance_value( 'enable_title_link' ) === 'yes' ) {
										$title_html .= '</a>';
									}
								}
								$title_html .= '</div>';
								echo $title_html;
								?>
							</div>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
		<?php
	}
}
