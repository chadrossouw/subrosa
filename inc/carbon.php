<?php 
/*Carbon Fields Functions*/

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'sr_attach_theme_options' );
function sr_attach_theme_options() {
    Container::make( 'post_meta', 'Titling' )
    ->set_context( 'carbon_fields_after_title' )
    ->where( 'post_type', '=', 'post' )
    ->add_fields( array(
        Field::make( 'checkbox', 'sr_home_feature', 'Feature on Home Page' )
        ->set_option_value( 'yes' ),
        Field::make( 'text', 'sr_subtitle', 'Subtitle' ),
        Field::make( 'checkbox', 'sr_display_amp', 'Show Ampersand in Subtitle' )
        ->set_option_value( 'yes' ),
        Field::make( 'rich_text', 'sr_extract', 'Extract' )
        ->set_help_text( 'This extract is displayed on Home page and Post page. Approx 35 -  60 words' ),
    ));
    Container::make( 'post_meta', 'Templating' )
    ->set_context( 'carbon_fields_after_title' )
    ->set_priority( 'low' )
    ->where( 'post_type', '=', 'post' )
    ->add_fields( array(
        Field::make( 'select', 'sr_template', 'Set the template')
        ->set_help_text( 'This template controls how the post display on the home page when featured' )
        ->set_options( array(
            'portrait_1' => 'Portrait with overlapping title',
            'portrait_2' => 'Portrait with transparency on image',
            'landscape_1' => 'Landscape with long title',
            'landscape_2' => 'Landscape with short title',
        ) ),
        Field::make( 'image', 'sr_secondary_feature', 'Transparent Featured Image' )
        ->set_help_text('Upload the PNG here')
        ->set_conditional_logic( array(
            'relation'=>'AND',
            array(
                'field'=> 'sr_template',
                'value'=> 'portrait_2',
            )
        ) ),
    ));
}

add_filter( 'crb_media_buttons_html', function( $html, $field_name ) {
	if ( $field_name === 'sr_extract' ) {
		return;
	}
	return $html;
}, 10, 2);