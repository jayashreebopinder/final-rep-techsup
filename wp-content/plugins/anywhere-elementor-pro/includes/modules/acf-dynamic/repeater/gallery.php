<?php

namespace Aepro\Modules\AcfDynamic\Repeater;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Plugin;

class Gallery extends Data_Tag {

	public function get_name() {
		return 'ae-gallery';
	}

	public function get_title() {
		return __( '(AE) ACF Repeater Media Gallery', 'ae-pro' );
	}

	public function get_group() {
		return 'ae-dynamic';
	}

	public function get_categories() {
		return [
			\Elementor\Modules\DynamicTags\Module::GALLERY_CATEGORY,
		];
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}
    //phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function register_controls() {
		DynamicHelper::instance()->ae_get_group_fields( $this, $this->get_supported_fields() );
	}

	protected function get_supported_fields() {
		return [
			'gallery',
		];
	}

	public function get_value( array $options = [] ) {
		$images   = [];
		$settings = $this->get_settings();
		$value    = DynamicHelper::instance()->get_repeater_data( $settings );
		if ( ! empty( $value ) ) {
			foreach ( $value as $image ) {
				$images[] = [
					'id' => $image,
				];
			}
		}

		return $images;
	}
}
