<?php

add_filter('show_admin_bar', '__return_false');

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('init', 'register_menues');
add_action('customize_register', 'dhm_customize_register');

add_shortcode('dhm_feature', 'dhm_feature_func');
add_shortcode('dhm_awesome_person', 'dhm_shortcode_awesome_person');

function register_menues() {
  register_nav_menu('header-menu', __('Header Menu'));
}

function theme_enqueue_styles() {
	wp_enqueue_style('parent_stylesheet', get_template_directory_uri() . '/style.css', false, filemtime(get_template_directory() . '/style.css'));
	wp_enqueue_style('theme_stylesheet', get_stylesheet_directory_uri() . '/style.css', false, filemtime(get_stylesheet_directory() . '/style.css'));
}


function dhm_feature_func($atts, $content = null) {
	$a = shortcode_atts(array(
		'img' => 'something',
		'side' => 'right',
	), $atts );

	return '
		<div class="feature ' . esc_attr($a['side']) . '">
			<section>
				<div><img style="width: 300px;" src="' . esc_attr($a['img']) . '" alt="" /></div>
				<div>' . do_shortcode($content) . '</div>
			</section>
		</div>
	';
}

function dhm_shortcode_awesome_person($atts) {
	$a = shortcode_atts(array(
		'name' => 'Name',
		'title' => 'Title',
		'picture' => 'https://do512blog.files.wordpress.com/2011/09/pirate_tweet.jpg',
		'quote' => 'Daheim 4TW',
	), $atts );

	return '
		<div class="awesome-person">
			<div class="picture">
				<div style="background-image: url(' . esc_attr($a['picture']) . ')"></div>
			</div>
			<h2 class="name">' . $a['name'] . '</h2>
			<h3 class="title">' . $a['title'] . '</h3>
			<p class="quote">' . $a['quote'] . '</p>
		</div>
	';
}

function dhm_customize_register($wp_customize) {
	$wp_customize->add_section('dhm_options', array(
		'title' => __('Dahiem Options', 'dhm' ),
		'priority' => 35,
		'description' => __('Allows you to customize some settings for Daheim.', 'dhm'),
	));

	$wp_customize->add_setting('punchline', array(
		'default' => 'Daheim. Hier sprechen wir mitmenschlich.',
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dhm_punchline', array(
		'label' => __('Punchline', 'dhm'),
		'section' => 'dhm_options',
		'settings' => 'punchline',
		'priority' => 10,
	)));

	$wp_customize->add_setting('newsletter_caption', array(
		'default' => 'Daheim startet seinen kostenlosen Service im Frühjahr 2016. Bleibt auf dem Laufenden!',
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dhm_newsletter_caption', array(
		'label' => __('Newsletter Caption', 'dhm'),
		'section' => 'dhm_options',
		'settings' => 'newsletter_caption',
		'priority' => 10,
	)));
}
