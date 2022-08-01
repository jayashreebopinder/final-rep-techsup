<?php

namespace Aepro\Modules\PostDynamic;

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
		
		\Elementor\Plugin::$instance->dynamic_tags->register_group(
			'ae-post-dynamic',
			[
				'title' => __( 'Post (AE)', 'ae-pro' ),
			]
		);

		if ( \Aepro\Plugin::$_level >= 1 ) {
			//--Post Dynamic
			$dynamic_tags->register_tag( Post_Title::class );
			$dynamic_tags->register_tag( Post_Featured_Image::class );
			$dynamic_tags->register_tag( Post_Custom_Field::class );
			$dynamic_tags->register_tag( Post_Term::class );
			$dynamic_tags->register_tag( Post_Url::class );
			$dynamic_tags->register_tag( Post_Date::class );
			$dynamic_tags->register_tag( Post_Time::class );
			$dynamic_tags->register_tag( Post_Excerpt::class );
			$dynamic_tags->register_tag( Post_Gallery::class );
		}
	}

}
