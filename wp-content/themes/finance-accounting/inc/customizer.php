<?php
/**
 * Finance Accounting: Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function finance_accounting_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'finance_accounting_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'finance-accounting' ),
	    'description' => __( 'Description of what this panel does.', 'finance-accounting' ),
	) );

	$wp_customize->add_section( 'finance_accounting_general_option', array(
    	'title'      => __( 'General Settings', 'finance-accounting' ),
		'priority'   => 30,
		'panel' => 'finance_accounting_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('finance_accounting_layout_settings',array(
        'default' => __('Right Sidebar','finance-accounting'),
        'sanitize_callback' => 'finance_accounting_sanitize_choices'	        
	));

	$wp_customize->add_control('finance_accounting_layout_settings',array(
        'type' => 'radio',
        'label' => __('Do you want this section','finance-accounting'),
        'section' => 'finance_accounting_general_option',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','finance-accounting'),
            'Right Sidebar' => __('Right Sidebar','finance-accounting'),
            'One Column' => __('One Column','finance-accounting'),
            'Three Columns' => __('Three Columns','finance-accounting'),
            'Four Columns' => __('Four Columns','finance-accounting'),
            'Grid Layout' => __('Grid Layout','finance-accounting')
        ),
	));

	//Topbar section
	$wp_customize->add_section('finance_accounting_topbar',array(
		'title'	=> __('Topbar','finance-accounting'),
		'description'	=> __('Add Topbar Content here','finance-accounting'),
		'priority'	=> null,
		'panel' => 'finance_accounting_panel_id',
	));

	$wp_customize->add_setting('finance_accounting_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('finance_accounting_time',array(
		'label'	=> __('Timing','finance-accounting'),
		'section'	=> 'finance_accounting_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('finance_accounting_time1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('finance_accounting_time1',array(
		'label'	=> __('Add Time','finance-accounting'),
		'section'	=> 'finance_accounting_topbar',
		'setting'	=> 'finance_accounting_time',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('finance_accounting_mail',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('finance_accounting_mail',array(
		'label'	=> __('Email Text','finance-accounting'),
		'section'	=> 'finance_accounting_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('finance_accounting_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('finance_accounting_email',array(
		'label'	=> __('Add Email','finance-accounting'),
		'section'	=> 'finance_accounting_topbar',
		'setting'	=> 'finance_accounting_email',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('finance_accounting_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('finance_accounting_call',array(
		'label'	=> __('Phone Text','finance-accounting'),
		'section'	=> 'finance_accounting_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('finance_accounting_call1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('finance_accounting_call1',array(
		'label'	=> __('Add Phone Number','finance-accounting'),
		'section'	=> 'finance_accounting_topbar',
		'setting'	=> 'finance_accounting_call',
		'type'		=> 'text'
	));

	//Social Icons
	$wp_customize->add_section('finance_accounting_social_link',array(
		'title'	=> __('Social Media','finance-accounting'),
		'description'	=> __('Add Social Media Url here','finance-accounting'),
		'priority'	=> null,
		'panel' => 'finance_accounting_panel_id',
	));

	$wp_customize->add_setting('finance_accounting_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('finance_accounting_facebook_url',array(
		'label'	=> __('Add Facebook link','finance-accounting'),
		'section'	=> 'finance_accounting_social_link',
		'setting'	=> 'finance_accounting_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('finance_accounting_google_plus_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('finance_accounting_google_plus_url',array(
		'label'	=> __('Add Google Plus link','finance-accounting'),
		'section'	=> 'finance_accounting_social_link',
		'setting'	=> 'finance_accounting_google_plus_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('finance_accounting_vk_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('finance_accounting_vk_url',array(
		'label'	=> __('Add vk link','finance-accounting'),
		'section'	=> 'finance_accounting_social_link',
		'setting'	=> 'finance_accounting_vk_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('finance_accounting_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('finance_accounting_youtube_url',array(
		'label'	=> __('Add Youtube link','finance-accounting'),
		'section'	=> 'finance_accounting_social_link',
		'setting'	=> 'finance_accounting_youtube_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('finance_accounting_linkdin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	) );	
	$wp_customize->add_control('finance_accounting_linkdin_url',array(
		'label'	=> __('Add Linkdin link','finance-accounting'),
		'section'	=> 'finance_accounting_social_link',
		'setting'	=> 'finance_accounting_linkdin_url',
		'type'	=> 'url'
	) );

	//home page slider
	$wp_customize->add_section( 'finance_accounting_slider' , array(
    	'title'      => __( 'Slider Settings', 'finance-accounting' ),
		'priority'   => null,
		'panel' => 'finance_accounting_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'finance_accounting_slide_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'finance_accounting_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'finance_accounting_slide_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'finance-accounting' ),
			'section'  => 'finance_accounting_slider',
			'type'     => 'dropdown-pages'
		) );

	}

	//About
	$wp_customize->add_section('finance_accounting_services',array(
		'title'	=> __('Service','finance-accounting'),
		'description'	=> __('Add Service Section below.','finance-accounting'),
		'panel' => 'finance_accounting_panel_id',
	));

	$wp_customize->add_setting('finance_accounting_section_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('finance_accounting_section_title',array(
		'label'	=> __('Section title','finance-accounting'),
		'section'	=> 'finance_accounting_services',
		'setting'	=> 'finance_accounting_section_title',
		'type'		=> 'text'
	));

	$post_list = get_posts();
	$i = 0;
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('finance_accounting_single_post',array(
		'sanitize_callback' => 'finance_accounting_sanitize_choices',
	));
	$wp_customize->add_control('finance_accounting_single_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','finance-accounting'),
		'section' => 'finance_accounting_services',
	));

	$wp_customize->add_setting('finance_accounting_about_name',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('finance_accounting_about_name',array(
		'label'	=> __('See more text','finance-accounting'),
		'section'	=> 'finance_accounting_services',
		'setting'	=> 'finance_accounting_about_name',
		'type'		=> 'text'
	));

	//Category1
	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('finance_accounting_blogcategory_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('finance_accounting_blogcategory_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','finance-accounting'),
		'section' => 'finance_accounting_services',
	));

	$wp_customize->add_setting('finance_accounting_blogcategory_setting1',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('finance_accounting_blogcategory_setting1',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','finance-accounting'),
		'section' => 'finance_accounting_services',
	));

	//Footer
	$wp_customize->add_section( 'finance_accounting_footer' , array(
    	'title'      => __( 'Footer Text', 'finance-accounting' ),
		'priority'   => null,
		'panel' => 'finance_accounting_panel_id'
	) );

	$wp_customize->add_setting('finance_accounting_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('finance_accounting_footer_text',array(
		'label'	=> __('Add Copyright Text','finance-accounting'),
		'section'	=> 'finance_accounting_footer',
		'setting'	=> 'finance_accounting_footer_text',
		'type'		=> 'text'
	));


	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'finance_accounting_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'finance_accounting_customize_partial_blogdescription',
	) );
	
}
add_action( 'customize_register', 'finance_accounting_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @since Finance Accounting 1.0
 * @see finance-accounting_customize_register()
 *
 * @return void
 */
function finance_accounting_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Finance Accounting 1.0
 * @see finance-accounting_customize_register()
 *
 * @return void
 */
function finance_accounting_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function finance_accounting_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'footer-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Finance_Accounting_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Finance_Accounting_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Finance_Accounting_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Finance Accounting', 'finance-accounting' ),
					'pro_text' => esc_html__( 'Go Pro', 'finance-accounting' ),
					'pro_url'  => esc_url('https://www.themeseye.com/wordpress/accounting-finance-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'finance-accounting-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'finance-accounting-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Finance_Accounting_Customize::get_instance();