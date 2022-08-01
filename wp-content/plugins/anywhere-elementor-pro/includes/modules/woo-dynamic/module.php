<?php

namespace Aepro\Modules\WooDynamic;

use Aepro\Base\ModuleBase;

class Module extends ModuleBase {
    private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {
		add_action( 'elementor/dynamic_tags/register', [ $this, 'register_dynamic_tags' ] );
	}

	public function register_dynamic_tags( $dynamic_tags ) {
		
		if ( class_exists( 'woocommerce' ) ) {
			\Elementor\Plugin::$instance->dynamic_tags->register_group(
				'ae-woo-dynamic',
				[
					'title' => __( 'WooCommerce (AE)', 'ae-pro' ),
				]
			);
			$dynamic_tags->register_tag( Product_Title::class );
			$dynamic_tags->register_tag( Product_Price::class );
			$dynamic_tags->register_tag( Product_Sale::class );
			$dynamic_tags->register_tag( Product_SKU::class );
			$dynamic_tags->register_tag( Product_Rating::class );
			$dynamic_tags->register_tag( Product_Stock::class );
			$dynamic_tags->register_tag( Product_Short_Description::class );
			$dynamic_tags->register_tag( Product_Term::class );
			$dynamic_tags->register_tag( Product_Image::class );
			$dynamic_tags->register_tag( Product_Gallery::class );
			$dynamic_tags->register_tag( Product_Cat_Image::class );
		}
	}

}
