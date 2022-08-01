<?php

namespace Aepro\Modules\AcfDynamic;

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
		

		if ( \Aepro\Plugin::$_level >= 2 ) {
			if ( AE_ACF ) {

				\Elementor\Plugin::$instance->dynamic_tags->register_group(
					'ae-dynamic',
					[
						'title' => __( 'ACF (AE)', 'ae-pro' ),
					]
				);

				//--Acf Dynamic
				$dynamic_tags->register_tag( Text::class );
				$dynamic_tags->register_tag( Number::class );
				$dynamic_tags->register_tag( Url::class );
				$dynamic_tags->register_tag( Image::class );
				$dynamic_tags->register_tag( Color::class );

				// ACF-Group Dynamic
				$dynamic_tags->register_tag( Group\Text::class );
				$dynamic_tags->register_tag( Group\Image::class );
				$dynamic_tags->register_tag( Group\Url::class );
				$dynamic_tags->register_tag( Group\Number::class );
				$dynamic_tags->register_tag( Group\Color::class );
			}

			if(AE_ACF_PRO){
				//--Acf Dynamic
				$dynamic_tags->register_tag( Gallery::class );
				//--ACF Group Dynamic
				$dynamic_tags->register_tag( Group\Gallery::class );
				//--Acf Repeater Fields
				$dynamic_tags->register_tag( Repeater\Text::class );
				$dynamic_tags->register_tag( Repeater\Option::class );
				$dynamic_tags->register_tag( Repeater\Url::class );
				$dynamic_tags->register_tag( Repeater\Image::class );
				$dynamic_tags->register_tag( Repeater\Gallery::class );
				$dynamic_tags->register_tag( Repeater\Boolean::class );

				//--Acf Flexible Fields
				$dynamic_tags->register_tag( Flexible\Text::class );
				$dynamic_tags->register_tag( Flexible\Image::class );
				$dynamic_tags->register_tag( Flexible\Url::class );
				$dynamic_tags->register_tag( Flexible\Number::class );
				$dynamic_tags->register_tag( Flexible\Gallery::class );
				//$dynamic_tags->register_tag( AcfFlexibleDynamic\Color::class );
			}

		}
	}

}
