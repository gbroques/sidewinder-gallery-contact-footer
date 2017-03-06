<?php 
/*
Plugin Name: Sidewinder Gallery Contact Footer
Plugin URI: http://groques.com
Description: Adds contact information to the homepage gallery for the Sidewinder theme.
Author: G Roques
Version: 1.0
Author URI: http://groques.com
*/

// Styles Format:  wp_enqueue_style($handle, $src, $deps, $ver, $media);
wp_register_style('sidewinder-gallery-contact-footer-style', plugins_url('sidewinder-gallery-contact-footer.css', __FILE__), array('style'));
wp_enqueue_style('sidewinder-gallery-contact-footer-style');

function my_child_theme_options() {
	$contact_information_tab = array(
	    "name" => "contact_information_tab",
	    "title" => __( "Contact Information", "gpp" ),
	    "sections" => array(
	        "contact_information_section" => array(
	            "name" => "contact_information_section",
	            "title" => __( "Contact Information", "gpp" ),
	            "description" => __( "Enter an email address and phone number to be displayed at the bottom of the homepage gallery.", "gpp" )
	        ),
	        "social_media_section" => array(
	            "name" => "social_media_section",
	            "title" => __( "Social Media", "gpp" ),
	            "description" => __( "Add links to your social media. Any fields left blank will not appear.", "gpp" )
	        )
	    )
	);

	gpp_register_theme_option_tab( $contact_information_tab );

	$options = array(
		"email" => array(
	        "tab" => "contact_information_tab",
	        "name" => "email",
	        "title" => "Email Address",
	        "description" => __( "Enter an e-mail to be contacted by.", "gpp" ),
	        "section" => "contact_information_section",
	        "since" => "1.0",
	        "id" => "email",
	        "type" => "text",
	        "sanitize" => "html",
	        "default" => ""
        ),
		"phone_number" => array(
	        "tab" => "contact_information_tab",
	        "name" => "phone_number",
	        "title" => "Phone Number",
	        "description" => __( "Enter a phone number to be contacted by.", "gpp" ),
	        "section" => "contact_information_section",
	        "since" => "1.0",
	        "id" => "phone-number",
	        "type" => "text",
	        "sanitize" => "html",
	        "default" => ""
        ),
	    'instagram' => array(
	        "tab" => "contact_information_tab",
	        "name" => "instagram",
	        "title" => __( "Instagram", "gpp" ),
	        "description" => __( 'Link to your Instagram.', "gpp" ),
	        "section" => "social_media_section",
	        "since" => "1.0",
	        "id" => "instagram",
	        "type" => "text"
	    ),
	    'email' => array(
	        "tab" => "contact_information_tab",
	        "name" => "email",
	        "title" => __( "Email", "gpp" ),
	        "description" => __( 'Enter an email address to be contacted by.', "gpp" ),
	        "section" => "social_media_section",
	        "since" => "1.0",
	        "id" => "email",
	        "type" => "text"
	    ),
	    'behance' => array(
	        "tab" => "contact_information_tab",
	        "name" => "behance",
	        "title" => __( "Behance", "gpp" ),
	        "description" => __( 'Link to your Behance.', "gpp" ),
	        "section" => "social_media_section",
	        "since" => "1.0",
	        "id" => "behance",
	        "type" => "text"
	    ),
	);

	// Script Format:  wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
	wp_register_script('sidewinder-gallery-contact-footer-script', plugins_url('sidewinder-gallery-contact-footer.js', __FILE__), array('jquery'), false, true);

	$scriptSettings = array_merge(
		get_option(gpp_get_current_theme_id() . '_options'),
		get_social_media_icon_paths()
	);
	wp_localize_script('sidewinder-gallery-contact-footer-script', 'settings', $scriptSettings);
	wp_enqueue_script('sidewinder-gallery-contact-footer-script');

	gpp_register_theme_options( $options );

}

function get_social_media_icon_paths() {
	return array(
		"social_media_icons" => array(
			"instagram" => file_get_contents('svg/instagram-with-circle.svg', FILE_USE_INCLUDE_PATH),
			"behance" => file_get_contents('svg/behance.svg', FILE_USE_INCLUDE_PATH),
			"email" => file_get_contents('svg/mail4.svg', FILE_USE_INCLUDE_PATH)
		),
	);
}

add_filter('child_theme_options', 'my_child_theme_options');