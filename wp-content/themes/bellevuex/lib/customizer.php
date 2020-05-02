<?php
/**
 * _s Theme Customizer.
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
//add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
//add_action( 'customize_preview_init', '_s_customize_preview_js' );


// Add the theme configuration
Bellevue_Kirki::add_config( 'bellevue_theme', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );

// Create a Panel for our theme options.
Bellevue_Kirki::add_panel( 'th_options', array(
    'priority'    => 10,
    'title'       => __( 'Theme Options', 'bellevue' ),
    'description' => __( 'My Description', 'bellevue' ),
) );


// LOGO SECTION
Bellevue_Kirki::add_section( 'logo', array(
    'title'      => esc_attr__( 'Logo', 'bellevue' ),
    'priority'   => 2,
    'panel'          => 'th_options',
    'capability' => 'edit_theme_options',
) );

// Logo : Enable Retina Support.
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_retinajs_logo',
    'label'       => esc_html__( 'High-resolution/Retina Logo Support', 'bellevue' ),
    'description' => esc_html__( 'Automatically serve up your high-resolution logo to devices that support them.', 'bellevue' ),
    'section'     => 'logo',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Logo : Height
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'number',
    'settings'    => 'themo_logo_height',
    'label'       => esc_html__( 'Logo Height', 'bellevue' ),
    'description' => esc_html__( 'Set height and then \'Publish\' BEFORE uploading your logo.', 'bellevue' ),
    'section'     => 'logo',
    'default'     => 100,
    'choices'     => array(
        'min'  => '10',
        'max'  => '300',
        'step' => '1',
    ),
    'output' => array(
        array(
            'element'  => '#logo img',
            'property' => 'max-height',
            'units'    => 'px',
        ),
        array(
            'element'  => '#logo img',
            'property' => 'width',
            'value_pattern' => 'auto'
        ),
    ),
) );

Bellevue_Kirki::add_field( 'theme_config_id', [
    'type'        => 'custom',
    'settings'    => 'themo_logo_resize_help',
    'label'       => esc_html__('Resizing', 'bellevue'),
    'section'     => 'logo',
    'default'     => '<div class="th-theme-support">' . __('To increase your logo size, set the new \'Logo Height\' above and \'Publish\' before you \'Remove\' and re-upload your logo. The theme resizes the logo during the upload process.', 'bellevue') . '</div>',
    'priority'    => 10,
] );

// Logo : Logo Image
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'image',
    'settings'    => 'themo_logo',
    'label'       => esc_html__( 'Logo', 'bellevue' ),
    'description' => esc_html__( 'For retina support, upload a logo that is twice the height set above.', 'bellevue' ) ,
    'section'     => 'logo',
    'default'     => '',
    'priority'    => 10,
) );





// Logo : Transparent Switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_logo_transparent_header_enable',
    'label'       => esc_html__( 'Alternative logo', 'bellevue' ),
    'description'       => esc_html__( 'Used as an option for transparency header', 'bellevue' ),
    'section'     => 'logo',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Logo : Transparent Logo
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'image',
    'settings'    => 'themo_logo_transparent_header',
    'label'       => esc_html__( 'Alternative logo upload', 'bellevue' ),
    'description' => esc_html__( 'For retina support, upload a logo that is twice the height set above.', 'bellevue' ) ,
    'section'     => 'logo',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'themo_logo_transparent_header_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );


// MENU SECTION
Bellevue_Kirki::add_section( 'menu', array(
    'title'      => esc_attr__( 'Menu & Header', 'bellevue' ),
    'priority'   => 2,
    'panel'          => 'th_options',
    'capability' => 'edit_theme_options',
) );

// Menu : Top Nav Switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_top_nav_switch',
    'label'       => esc_html__( 'Top Bar', 'bellevue' ),
    'section'     => 'menu',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Menu : Top Nav Text
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'     => 'textarea',
    'settings' => 'themo_top_nav_text',
    'label'    => esc_html__( 'Top Bar Text', 'bellevue' ),
    'section'  => 'menu',
    'default'  => esc_attr__( 'Welcome', 'bellevue' ),
    'priority' => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'themo_top_nav_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Menu : Icon Block

Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'repeater',
    'label'       => esc_attr__( 'Top Bar Icons', 'bellevue' ),
    'description' => esc_html__( 'Use any', 'bellevue' ). ' <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a> icon (e.g.: fa fa-twitter). <a href="http://fontawesome.io/icons/" target="_blank">'.esc_html__( 'Full List Here', 'bellevue' ).'</a>',
    'section'     => 'menu',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Icon Block', 'bellevue' ),
    ),
    'settings'    => 'themo_top_nav_icon_blocks',
    'default'     => array(
        array(
            'title' => esc_attr__( 'Contact Us', 'bellevue' ),
            'themo_top_nav_icon'  => 'fa fa-envelope-open-o',
            'themo_top_nav_icon_url'  => 'mailto:contact@themovation.com',
            'themo_top_nav_icon_url_target'  => '',
        ),
        array(
            'title' => esc_attr__( 'How to Find Us', 'bellevue' ),
            'themo_top_nav_icon'  => 'fa fa-map-o',
            'themo_top_nav_icon_url'  => '#',
            'themo_top_nav_icon_url_target'  => '',
        ),
        array(
            'title' => esc_attr__( '250-555-5555', 'bellevue' ),
            'themo_top_nav_icon'  => 'fa fa-mobile',
            'themo_top_nav_icon_url'  => 'tel:250-555-5555',
            'themo_top_nav_icon_url_target'  => '',
        ),
        array(
            'themo_top_nav_icon'  => 'fa fa-twitter',
            'themo_top_nav_icon_url'  => 'http://twitter.com',
            'themo_top_nav_icon_url_target'  => '1',
        ),
    ),
    'fields' => array(
        'title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link Text', 'bellevue' ),
            'default'     => '',
        ),
        'themo_top_nav_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Icon', 'bellevue' ),
            'default'     => '',
        ),
        'themo_top_nav_icon_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link URL', 'bellevue' ),
            'default'     => '',
        ),
        'themo_top_nav_icon_url_target' => array(
            'type'        => 'checkbox',
            'label'       => esc_attr__( 'Open Link in New Window', 'bellevue' ),
            'default'     => '',
        ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_top_nav_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Menu : Enable Dark Header
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_header_style',
    'label'       => esc_html__( 'Header Style', 'bellevue' ),
    'section'     => 'menu',
    'default'     => 'dark',
    'priority'    => 10,
    'choices'     => array(
        'dark'  => esc_attr__( 'Dark', 'bellevue' ),
        'light' => esc_attr__( 'Light', 'bellevue' ),
    ),
) );

// Menu : Dropdown Style
Bellevue_Kirki::add_field( 'uplands_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_dropdown_style',
    'label'       => esc_html__( 'Dropdown Style', 'uplands' ),
    'section'     => 'menu',
    'default'     => 'dark',
    'priority'    => 10,
    'choices'     => array(
        'dark'  => esc_attr__( 'Dark', 'uplands' ),
        'light' => esc_attr__( 'Light', 'uplands' ),
    ),
) );

// Menu : Social Icno Switch
Bellevue_Kirki::add_field( 'uplands_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_nav_social_switch',
    'label'       => esc_html__( 'Social Icons', 'uplands' ),
    'section'     => 'menu',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'uplands' ),
        'off' => esc_attr__( 'Disable', 'uplands' ),
    ),
) );


// Menu : Top Menu Margin

Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'number',
    'settings'    => 'themo_nav_top_margin',
    'label'       => esc_html__( 'Navigation Top Margin', 'bellevue' ),
    'description' => esc_html__( 'Set top margin value for the navigation bar', 'bellevue' ),
    'section'     => 'menu',
    'default'     => 19,
    'choices'     => array(
        'min'  => '0',
        'max'  => '300',
        'step' => '1',
    ),
    'output' => array(
        array(
            'element'  => '.navbar .navbar-nav',
            'property' => 'margin-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.navbar .navbar-toggle',
            'property' => 'top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.themo_cart_icon',
            'property' => 'margin-top',
            'value_pattern' => 'calc($px + 10px)'
        ),
    ),
) );

// Menu : Widget Title Underland
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'transparent_header_border_color_switch',
    'label'       => esc_html__( 'Transparent Header Border', 'bellevue' ),
    'section'     => 'menu',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
    'output' => array(
        array(
            'element'  => '.navbar-default[data-transparent-header="true"]',
            'property' => 'border-bottom',
            'value_pattern' => '1px solid',
            'exclude' => array( false ),
        ),

        //
    ),

) );

// Menu : Header Border
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'transparent_header_border_color',
    'label'       => esc_attr__( 'Border Color', 'bellevue' ),
    'section'     => 'menu',
    'default'     => 'rgba(255,255,255,.3)',
    'priority'    => 10,
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(

        array(
            'element'  => '.navbar-default[data-transparent-header="true"]',
            'property' => 'border-color',
        ),

    ),
    //padding-bottom: 20px
    'active_callback'    => array(
        array(
            'setting'  => 'transparent_header_border_color_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );


// Menu : Sticky Header
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_sticky_header',
    'label'       => esc_html__( 'Sticky Header', 'bellevue' ),
    'section'     => 'menu',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );


// COLOR PANEL
Bellevue_Kirki::add_section( 'color', array(
    'title'      => esc_attr__( 'Color', 'bellevue' ),
    'priority'   => 2,
    'panel'          => 'th_options',
    'capability' => 'edit_theme_options',
) );

// Color : Primary
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'color_primary',
    'label'       => esc_attr__( 'Primary Color', 'bellevue' ),
    'description'       => esc_attr__( 'This color appears in button options, links, and some headings throughout the theme', 'bellevue' ),
    'section'     => 'color',
    'default'     => '#f96d64',
    'priority'    => 10,
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(

        array(
            'element'  => '.btn-cta-primary,.navbar .navbar-nav>li>a:hover:after,.navbar .navbar-nav>li.active>a:after,.navbar .navbar-nav>li.active>a:hover:after,.navbar .navbar-nav>li.active>a:focus:after,form input[type=submit],html .woocommerce a.button.alt,html .woocommerce-page a.button.alt,html .woocommerce a.button,html .woocommerce-page a.button,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce #respond input#submit.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit.disabled,.woocommerce #respond input#submit:disabled,.woocommerce #respond input#submit:disabled[disabled],.woocommerce a.button.disabled,.woocommerce a.button:disabled,.woocommerce a.button:disabled[disabled],.woocommerce button.button.disabled,.woocommerce button.button:disabled,.woocommerce button.button:disabled[disabled],.woocommerce input.button.disabled,.woocommerce input.button:disabled,.woocommerce input.button:disabled[disabled],.woocommerce #respond input#submit.disabled:hover,.woocommerce #respond input#submit:disabled:hover,.woocommerce #respond input#submit:disabled[disabled]:hover,.woocommerce a.button.disabled:hover,.woocommerce a.button:disabled:hover,.woocommerce a.button:disabled[disabled]:hover,.woocommerce button.button.disabled:hover,.woocommerce button.button:disabled:hover,.woocommerce button.button:disabled[disabled]:hover,.woocommerce input.button.disabled:hover,.woocommerce input.button:disabled:hover,.woocommerce input.button:disabled[disabled]:hover,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,p.demo_store,.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,.th-conversion form input[type=submit],.th-conversion .with_frm_style input[type=submit],.th-pricing-column.th-highlight,.search-submit,.search-submit:hover,.widget .tagcloud a:hover,.footer .tagcloud a:hover,.btn-standard-primary-form form .frm_submit input[type=submit],.btn-standard-primary-form form .frm_submit input[type=submit]:hover,.btn-ghost-primary-form form .frm_submit input[type=submit]:hover,.btn-cta-primary-form form .frm_submit input[type=submit],.btn-cta-primary-form form .frm_submit input[type=submit]:hover,.th-widget-area form input[type=submit],.th-widget-area .with_frm_style .frm_submit input[type=submit], .th-header-wrap h2.th-title-divider:after, form input[type=submit]:hover, .with_frm_style .frm_submit input[type=submit]:hover, .with_frm_style .frm_submit input[type=button]:hover, .frm_form_submit_style:hover, .with_frm_style.frm_login_form input[type=submit]:hover',
            'property' => 'background-color',
        ),
        array(
            'element'  => 'a,.accent,.navbar .navbar-nav .dropdown-menu li.active a,.navbar .navbar-nav .dropdown-menu li a:hover,.navbar .navbar-nav .dropdown-menu li.active a:hover,.page-title h1,.inner-container>h1.entry-title,.woocommerce ul.products li.product .price,.woocommerce ul.products li.product .price del,.woocommerce .single-product .product .price,.woocommerce.single-product .product .price,.woocommerce .single-product .product .price ins,.woocommerce.single-product .product .price ins,.a2c-ghost.woocommerce a.button,.th-cta .th-cta-text span,.elementor-widget-themo-header .th-header-wrap .elementor-icon-box-title,.elementor-widget-themo-info-card .th-info-card-wrap .elementor-icon-box-title,.map-info h3,.th-pkg-content h3,.th-pricing-cost,.elementor-widget-themo-service-block .th-service-block-w .elementor-icon-box-title,#main-flex-slider .slides h1,.th-team-member-social a i:hover,.elementor-widget-toggle .elementor-toggle .elementor-toggle-title,.elementor-widget-toggle .elementor-toggle .elementor-toggle-title.active,.elementor-widget-toggle .elementor-toggle .elementor-toggle-icon',
            'property' => 'color',
        ),
        array(
            'element'  => '.btn-standard-primary,.btn-ghost-primary:hover,.pager li>a:hover,.pager li>span:hover,.a2c-ghost.woocommerce a.button:hover',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.btn-standard-primary,.btn-ghost-primary:hover,.pager li>a:hover,.pager li>span:hover,.a2c-ghost.woocommerce a.button:hover,.btn-standard-primary-form form .frm_submit input[type=submit],.btn-standard-primary-form form .frm_submit input[type=submit]:hover,.btn-ghost-primary-form form .frm_submit input[type=submit]:hover,.btn-ghost-primary-form form .frm_submit input[type=submit]',
            'property' => 'border-color',
        ),
        array(
            'element'  => '.btn-ghost-primary,.th-portfolio-filters a.current,.a2c-ghost.woocommerce a.button,.btn-ghost-primary-form form .frm_submit input[type=submit]',
            'property' => 'color',
        ),
        array(
            'element'  => '.btn-ghost-primary,.th-portfolio-filters a.current,.a2c-ghost.woocommerce a.button, .th-header-wrap .th-header-divider ',
            'property' => 'border-color',
        ),
        array(
            'element'  => 'form select:focus,form textarea:focus,form input:focus,.th-widget-area .widget select:focus,.search-form input:focus',
            'property' => 'border-color',
            'suffix' => '!important',
        ),
        array(
            'element'  => '.wpbs-form .wpbs-form-form .wpbs-form-submit, .wpbs-form .wpbs-form-form .wpbs-form-submit:hover, .wpbs-form .wpbs-form-form .wpbs-form-submit:active, .wpbs-form .wpbs-form-form .wpbs-form-submit:focus',
            'property' => 'background-color',
            'suffix' => '!important',
        ),

    ),
) );

// Color : Accent
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'color_accent',
    'label'       => esc_attr__( 'Accent Color', 'bellevue' ),
    'description'       => esc_attr__( 'This color appears in icons, button options, and a few details throughout the theme.', 'bellevue' ),
    'section'     => 'color',
    'default'     => '#237a87',
    'priority'    => 10,
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => '.elementor-widget-themo-header .th-header-wrap .elementor-icon,.elementor-widget-themo-header.elementor-view-default .th-header-wrap .elementor-icon,.elementor-widget-themo-service-block .th-service-block-w .elementor-icon,.elementor-widget-themo-service-block.elementor-view-default .th-service-block-w .elementor-icon',
            'property' => 'color',
        ),
        array(
            'element'  => '.btn-cta-accent,.a2c-cta.woocommerce a.button,.a2c-cta.woocommerce a.button:hover,.elementor-widget-themo-header.elementor-view-stacked .th-header-wrap .elementor-icon,.elementor-widget-themo-service-block.elementor-view-stacked .th-service-block-w .elementor-icon,.btn-standard-accent-form form .frm_submit input[type=submit],.btn-standard-accent-form form .frm_submit input[type=submit]:hover,.btn-ghost-accent-form form .frm_submit input[type=submit]:hover,.btn-cta-accent-form form .frm_submit input[type=submit],.btn-cta-accent-form form .frm_submit input[type=submit]:hover',
            'property' => 'background-color',
        ),
        array(
            'element'  => 'body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block',
            'property' => 'background',
            'suffix' => '!important',
        ),
        array(
            'element'  => 'body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,.btn-standard-accent-form form .frm_submit input[type=submit],.btn-standard-accent-form form .frm_submit input[type=submit]:hover,.btn-ghost-accent-form form .frm_submit input[type=submit]:hover,.btn-ghost-accent-form form .frm_submit input[type=submit]',
            'property' => 'border-color',
            'suffix' => '!important',
        ),
        array(
            'element'  => '.btn-standard-accent,.btn-ghost-accent:hover',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.btn-standard-accent,.btn-ghost-accent:hover',
            'property' => 'border-color',
        ),
        array(
            'element'  => '.btn-ghost-accent,.elementor-widget-themo-header.elementor-view-framed .th-header-wrap .elementor-icon,.elementor-widget-themo-service-block.elementor-view-framed .th-service-block-w .elementor-icon,.btn-ghost-accent-form form .frm_submit input[type=submit]',
            'property' => 'color',
        ),
        array(
            'element'  => '.btn-ghost-accent,.elementor-widget-themo-header.elementor-view-framed .th-header-wrap .elementor-icon,.elementor-widget-themo-service-block.elementor-view-framed .th-service-block-w .elementor-icon',
            'property' => 'border-color',
        ),
    ),
) );

//  TYPOGRAPHY SECTION
Bellevue_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', 'bellevue' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
    'panel'          => 'th_options',
) );

// Typography : Headings Text
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'typography',
    'settings'    => 'headers_typography',
    'label'       => esc_attr__( 'Headings Typography', 'bellevue' ),
    'description' => esc_attr__( 'Select options for all headings.', 'bellevue' ),
    'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headings on your site (post titles, widget titles etc).', 'bellevue' ),
    'section'     => 'typography',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Spinnaker',
        'variant'        => '400',
        'text-transform' => 'none',
    ),
    'output' => array(
        array(
            'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
        ),
    ),
) );

// Typography : Body Text
Bellevue_Kirki::add_field( 'bellevue_theme', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'bellevue' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', 'bellevue' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'bellevue' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Open Sans',
		'variant'        => '400',
		'font-size'      => '16px',
		'line-height'    => '1.65',
		'color'          => '#5c5c5c',
	),
	'output' => array(
		array(
			'element' => 'body,p,li',
		),
	),
) );



// Typography : Menu Text
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'typography',
    'settings'    => 'menu_typography',
    'label'       => esc_attr__( 'Menu Typography', 'bellevue' ),
    'description' => esc_attr__( 'Select the typography options for your Menu.', 'bellevue' ),
    'help'        => esc_attr__( 'The typography options you set here will override the Typography options for the main menu on your site.', 'bellevue' ),
    'section'     => 'typography',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Open Sans',
        'variant'        => '400',
        'font-size'      => '16px',
        'color'          => '#333333',
        'text-transform' => 'inherit',
    ),
    'output' => array(
        array(
            'element' => array( '.navbar .navbar-nav > li > a, .navbar .navbar-nav > li > a:hover, .navbar .navbar-nav > li.active > a, .navbar .navbar-nav > li.active > a:hover, .navbar .navbar-nav > li.active > a:focus, .navbar .navbar-nav > li.th-accent' ),
        ),
    ),
) );


// Typography : Headings Text
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'typography',
    'settings'    => 'additional_fonts_1',
    'label'       => esc_attr__( 'Include Additional Fonts', 'bellevue' ),
    'description' => esc_attr__( 'Use these inputs if you want to include additional font families or font weights.', 'bellevue' ),
    'section'     => 'typography',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Open Sans',
        'variant'        => '600',
    ),
) );

Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'typography',
    'settings'    => 'additional_fonts_2',
    'section'     => 'typography',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Open Sans',
        'variant'        => '700',
    ),
) );

// BLOG SECTION
Bellevue_Kirki::add_section( 'blog', array(
    'title'      => esc_attr__( 'Blog', 'bellevue' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'          => 'th_options',
) );

Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_automatic_post_excerpts',
    'label'       => esc_html__( 'Enable Automatic Post Excerpts', 'bellevue' ),
    'description'       => esc_html__( 'This option affects the Blog widget and the blog templates', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Blog. : Blog header switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_blog_index_layout_show_header',
    'label'       => esc_html__( 'Blog Homepage Header', 'bellevue' ),
    'description' => esc_html__( 'Show / Hide header for Blog Homepage', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Blog : Blog Header Align
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'themo_blog_index_layout_header_float',
    'label'       => esc_html__( 'Blog Homepage Header Position ', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'centered',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'centered'   => array(
            esc_attr__( 'Centered', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
    'active_callback'  => array(
        array(
            'setting'  => 'themo_blog_index_layout_show_header',
            'operator' => '==',
            'value'    => 1,
        ),
    )
) );

// Blog : Blog Sidebar Position
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'themo_blog_index_layout_sidebar',
    'label'       => esc_html__( 'Blog Homepage Sidebar Position', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'right',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'full'   => array(
            esc_attr__( 'None', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
) );



// Blog. : Blog Single header switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_single_post_layout_show_header',
    'label'       => esc_html__( 'Blog Single Page Header', 'bellevue' ),
    'description' => esc_html__( 'Show / Hide Page header for Blog Single', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Blog : Blog Single Header Align
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'themo_single_post_layout_header_float',
    'label'       => esc_html__( 'Blog Single Page Header Position ', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'centered',
    'priority'    => 10,
    'choices'     => array(
        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'centered'   => array(
            esc_attr__( 'Centered', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
    'active_callback'  => array(
        array(
            'setting'  => 'themo_single_post_layout_show_header',
            'operator' => '==',
            'value'    => 1,
        ),
    )
) );

// Blog : Blog Single Sidebar Position
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'themo_single_post_layout_sidebar',
    'label'       => esc_html__( 'Blog Single Sidebar Position', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'right',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'full'   => array(
            esc_attr__( 'None', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
) );


// Blog. : Default header switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_default_layout_show_header',
    'label'       => esc_html__( 'Archives Header', 'bellevue' ),
    'description' => esc_html__( 'Show / Hide header for Archives, 404, Search', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Blog : Default Header Align
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'themo_default_layout_header_float',
    'label'       => esc_html__( 'Archives Header Position ', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'centered',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'centered'   => array(
            esc_attr__( 'Centered', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
    'active_callback'  => array(
        array(
            'setting'  => 'themo_default_layout_show_header',
            'operator' => '==',
            'value'    => 1,
        ),
    )
) );

// Blog : Default Sidebar Position
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'themo_default_layout_sidebar',
    'label'       => esc_html__( 'Archives Sidebar Position', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'right',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'full'   => array(
            esc_attr__( 'None', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
) );

// Blog. : Category Masonry Style
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_blog_index_layout_masonry',
    'label'       => esc_html__( 'Masonry Style for Category Pages', 'bellevue' ),
    'section'     => 'blog',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// START MP Hotel Booking
if (class_exists('HotelBookingPlugin')) {
    Bellevue_Kirki::add_section('themo_mphb', array(
        'title' => esc_attr__('Accommodation & Booking', 'bellevue'),
        'priority' => 2,
        'panel' => 'th_options',
        'capability' => 'edit_theme_options',
    ));

    // MP Hotel Booking : Calendar Styling
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphb_use_theme_styling',
        'label' => esc_html__('Calendar Styling', 'bellevue'),
        //'description' => __( 'Show / Hide shopping cart icon in header', 'bellevue' ),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
        'output' => array(
            array(
                'element' => '.themo_mphb_availability_calendar .datepick, .datepick-popup .datepick.mphb-datepick-popup',
                'property' => 'width',
                'value_pattern' => 'auto',
                'suffix' => '!important',
                'exclude' => array(false)
            ),
            array(
                'element' => '.datepick-popup .datepick.mphb-datepick-popup',
                'property' => 'max-width',
                'value_pattern' => '600px',
                'exclude' => array(false)
            ),
        ),

    ));

    // MP Hotel Booking : Calendar Colour
    Bellevue_Kirki::add_field('bellevue_theme', [
        'type' => 'multicolor',
        'settings' => 'themo_mphb_date_colors',
        'label' => esc_html__('Calendar Colors', 'bellevue'),
        'section' => 'themo_mphb',
        'priority' => 10,
        'choices' => [
            'mphb_booked_date' => esc_html__('Date Booked', 'bellevue'),
            'mphb_available_date' => esc_html__('Date Available', 'bellevue'),
        ],
        'default' => [
            'mphb_booked_date' => '#f96d64',
            'mphb_available_date' => '#f4f6f2',
        ],
        'active_callback' => array(
            array(
                'setting' => 'themo_mphb_use_theme_styling',
                'operator' => '==',
                'value' => true,
            ),
        )
    ]);

    // MP Hotel Booking : Category Header
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_category_show_header',
        'label' => esc_html__('Category Header', 'bellevue'),
        'description' => esc_html__('Show / Hide header for Categories', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // MP Hotel Booking : Category Header Align
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_category_header_float',
        'label' => esc_html__('Category Header Position ', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'centered',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'centered' => array(
                esc_attr__('Centered', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'themo_mphp_category_show_header',
                'operator' => '==',
                'value' => 1,
            ),
        )
    ));

    // MP Hotel Booking : Category Sidebar Position
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_category_sidebar',
        'label' => esc_html__('Category Sidebar Position', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'right',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'full' => array(
                esc_attr__('None', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
    ));

    // MP Hotel Booking : Category Masonry Style
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_category_masonry',
        'label' => esc_html__('Category Masonry Style', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // MP Hotel Booking : Tag Header
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_tag_show_header',
        'label' => esc_html__('Tag Header', 'bellevue'),
        'description' => esc_html__('Show / Hide header for Tags', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // MP Hotel Booking : Tag Header Align
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_tag_header_float',
        'label' => esc_html__('Tag Header Position ', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'centered',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'centered' => array(
                esc_attr__('Centered', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'themo_mphp_tag_show_header',
                'operator' => '==',
                'value' => 1,
            ),
        )
    ));

    // MP Hotel Booking : Tag Sidebar Position
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_tag_sidebar',
        'label' => esc_html__('Tag Sidebar Position', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'right',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'full' => array(
                esc_attr__('None', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
    ));

    // MP Hotel Booking : Tag Masonry Style
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_tag_masonry',
        'label' => esc_html__('Tag Masonry Style', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // MP Hotel Booking : Amenities Header
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_amenities_show_header',
        'label' => esc_html__('Amenity Header', 'bellevue'),
        'description' => esc_html__('Show / Hide header for Amenities', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // MP Hotel Booking : Amenities Header Align
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_amenities_header_float',
        'label' => esc_html__('Amenity Header Position ', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'centered',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'centered' => array(
                esc_attr__('Centered', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'themo_mphp_amenities_show_header',
                'operator' => '==',
                'value' => 1,
            ),
        )
    ));

    // MP Hotel Booking : Amenities Sidebar Position
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_amenities_sidebar',
        'label' => esc_html__('Amenity Sidebar Position', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'right',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'full' => array(
                esc_attr__('None', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
    ));

    // MP Hotel Booking : Amenities Masonry Style
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_amenities_masonry',
        'label' => esc_html__('Amenity Masonry Style', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));


    // MP Hotel Booking : Service Header
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_service_show_header',
        'label' => esc_html__('Service Header', 'bellevue'),
        'description' => esc_html__('Show / Hide header for Services', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // MP Hotel Booking : Service Header Align
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_service_header_float',
        'label' => esc_html__('Service Header Position ', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'centered',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'centered' => array(
                esc_attr__('Centered', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'themo_mphp_service_show_header',
                'operator' => '==',
                'value' => 1,
            ),
        )
    ));

    // MP Hotel Booking : Service Sidebar Position
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_mphp_service_sidebar',
        'label' => esc_html__('Service Sidebar Position', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'right',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'full' => array(
                esc_attr__('None', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
    ));

    // MP Hotel Booking : Service Masonry Style
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_mphp_service_masonry',
        'label' => esc_html__('Service Masonry Style', 'bellevue'),
        'section' => 'themo_mphb',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));
}
// MP Hotel Booking End

// WOOCOMMERCE SECTION
if(th_is_woocommerce_activated()) {
    Bellevue_Kirki::add_section('woo', array(
        'title' => esc_attr__('WooCommerce', 'bellevue'),
        'priority' => 2,
        'panel' => 'th_options',
        'capability' => 'edit_theme_options',
    ));

    // Woo : Cart Switch
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_woo_show_cart_icon',
        'label' => esc_html__('Show Cart Icon', 'bellevue'),
        'description' => __('Show / Hide shopping cart icon in header', 'bellevue'),
        'section' => 'woo',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // Woo. : Disable Quantity from cart
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_disable_cart_qty',
        'label' => esc_html__('Disable Cart Quantity', 'bellevue'),
        'section' => 'woo',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
        'output' => array(
            array( /* Remove controls from Safari and Chrome */
                'element' => '.woocommerce-cart td.product-quantity input[type=number]',
                'property' => '-moz-appearance:textfield; pointer-events:none;',
                'value_pattern' => 'none',
                'exclude' => array(false)
            ),
            array( /* Remove controls from Safari and Chrome */
                'element' => '.woocommerce-cart td.product-quantity input[type=number]::-webkit-inner-spin-button, .woocommerce-cart td.product-quantity input[type=number]::-webkit-outer-spin-button ',
                'property' => '-webkit-appearance: none; -moz-appearance: none; appearance: none; margin: 0;',
                'value_pattern' => 'none',
                'exclude' => array(false)
            ),
        ),
    ));

    // Woo. : Hide Quantity from cart
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_hide_cart_qty',
        'label' => esc_html__('Hide Cart Quantity', 'bellevue'),
        'section' => 'woo',
        'default' => 'off',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
        'output' => array(
            array(
                'element' => '.woocommerce-cart td.product-quantity, .woocommerce-cart th.product-quantity',
                'property' => 'display',
                'value_pattern' => 'none',
                'exclude' => array(false)
            ),
        ),
    ));


    // Woo. : Hide Quantity from checkout
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_hide_checkout_qty',
        'label' => esc_html__('Hide Checkout Quantity', 'bellevue'),
        'section' => 'woo',
        'default' => 'off',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
        'output' => array(
            array(
                'element' => '.woocommerce-checkout strong.product-quantity',
                'property' => 'display',
                'value_pattern' => 'none',
                'exclude' => array(false)
            ),
        ),
    ));

    /*
    .woocommerce-cart td.product-quantity, .woocommerce-cart th.product-quantity, .woocommerce-checkout strong.product-quantity {display: none;}
     */

    // Woo : Cart Icon
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_woo_cart_icon',
        'label' => esc_html__('Cart Icon', 'bellevue'),
        'description' => esc_html__('Choose your shopping cart icon', 'bellevue'),
        'section' => 'woo',
        'default' => 'th-i-cart',
        'priority' => 10,
        'choices' => array(

            'th-i-cart' => array(
                esc_attr__('Bag', 'bellevue'),
            ),
            'th-i-cart2' => array(
                esc_attr__('Cart', 'bellevue'),
            ),
            'th-i-cart3' => array(
                esc_attr__('Cart 2', 'bellevue'),
            ),
            'th-i-card' => array(
                esc_attr__('Card', 'bellevue'),
            ),
            'th-i-card2' => array(
                esc_attr__('Card 2', 'bellevue'),
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'themo_woo_show_cart_icon',
                'operator' => '==',
                'value' => true,
            ),
        ),
    ));

    // Woo : Header Switch
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'switch',
        'settings' => 'themo_woo_show_header',
        'label' => esc_html__('Page Header', 'bellevue'),
        'description' => esc_html__('Show / Hide page header for woo categories, tags, taxonomies', 'bellevue'),
        'section' => 'woo',
        'default' => 'on',
        'priority' => 10,
        'choices' => array(
            'on' => esc_attr__('Enable', 'bellevue'),
            'off' => esc_attr__('Disable', 'bellevue'),
        ),
    ));

    // Woo : Header Align
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_woo_header_float',
        'label' => esc_html__('Align Page Header', 'bellevue'),
        'section' => 'woo',
        'default' => 'centered',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'centered' => array(
                esc_attr__('Centered', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),
        ),
        'active_callback' => array(
            array(
                'setting' => 'themo_woo_show_header',
                'operator' => '==',
                'value' => true,
            ),
        ),
    ));

    // Woo : Sidebar Position
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'radio-buttonset',
        'settings' => 'themo_woo_sidebar',
        'label' => esc_html__('Sidebar Position for Woo categories', 'bellevue'),
        'section' => 'woo',
        'default' => 'right',
        'priority' => 10,
        'choices' => array(

            'left' => array(
                esc_attr__('Left', 'bellevue'),
            ),
            'full' => array(
                esc_attr__('None', 'bellevue'),
            ),
            'right' => array(
                esc_attr__('Right', 'bellevue'),
            ),

        ),
    ));
}

// END WOO SECTION


// SLIDER SECTION
Bellevue_Kirki::add_section( 'slider', array(
    'title'      => esc_attr__( 'Slider', 'bellevue' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'          => 'th_options',
) );

// Slider : Autoplay
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_autoplay',
    'label'       => esc_attr__( 'Auto Play', 'bellevue' ),
    'description' => esc_attr__( 'Start slider automatically', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Animation
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_flex_animation',
    'label'       => esc_html__( 'Animation', 'bellevue' ),
    'description'        => esc_html__( 'Controls the animation type, "fade" or "slide".', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'fade',
    'priority'    => 10,
    'choices'     => array(
        'fade'   => array(
            esc_attr__( 'Fade', 'bellevue' ),
        ),
        'slide' => array(
            esc_attr__( 'Slide', 'bellevue' ),
        ),
    ),
) );

// Slider : Easing
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_flex_easing',
    'label'       => esc_html__( 'Easing', 'bellevue' ),
    'description'        => esc_html__( 'Determines the easing method used in jQuery transitions.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'swing',
    'priority'    => 10,
    'choices'     => array(
        'swing'   => array(
            esc_attr__( 'Swing', 'bellevue' ),
        ),
        'linear' => array(
            esc_attr__( 'Linear', 'bellevue' ),
        ),
    ),
) );

// Slider : Animation Loop
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_animationloop',
    'label'       => esc_attr__( 'Animation Loop', 'bellevue' ),
    'description' => esc_attr__( 'Gives the slider a seamless infinite loop.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Smooth Height
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_smoothheight',
    'label'       => esc_attr__( 'Smooth Height', 'bellevue' ),
    'description' => esc_attr__( 'Animate the height of the slider smoothly for slides of varying height.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Slide Speed
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'slider',
    'settings'    => 'themo_flex_slideshowspeed',
    'label'       => esc_html__( 'Slideshow Speed', 'bellevue' ),
    'description'        => esc_html__( 'Set the speed of the slideshow cycling, in milliseconds', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 4000,
    'choices'     => array(
        'min'  => '0',
        'max'  => '15000',
        'step' => '100',
    ),
) );

// Slider : Animation Speed
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'slider',
    'settings'    => 'themo_flex_animationspeed',
    'label'       => esc_html__( 'Animation Speed', 'bellevue' ),
    'description' => esc_html__( 'Set the speed of animations, in milliseconds', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 550,
    'choices'     => array(
        'min'  => '0',
        'max'  => '1200',
        'step' => '50',
    ),
) );

// Slider : Randomize
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_randomize',
    'label'       => esc_attr__( 'Randomize', 'bellevue' ),
    'description' => esc_attr__( 'Randomize slide order, on load', 'bellevue' ),
    'section'     => 'slider',
    'default'     => '0',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Puse on hover
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_pauseonhover',
    'label'       => esc_attr__( 'Pause on Hover', 'bellevue' ),
    'description' => esc_attr__( 'Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Touch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_touch',
    'label'       => esc_attr__( 'Touch', 'bellevue' ),
    'description' => esc_attr__( 'Allow touch swipe navigation of the slider on enabled devices.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Dir Nav
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_directionnav',
    'label'       => esc_attr__( 'Direction Nav', 'bellevue' ),
    'description' => esc_attr__( 'Create previous/next arrow navigation.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Slider : Paging Control
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_flex_controlNav',
    'label'       => esc_attr__( 'Paging Control', 'bellevue' ),
    'description' => esc_attr__( 'Create navigation for paging control of each slide.', 'bellevue' ),
    'section'     => 'slider',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// MISC. SECTION
Bellevue_Kirki::add_section( 'misc', array(
    'title'      => esc_attr__( 'Misc.', 'bellevue' ),
    'priority'   => 2,
    'panel'          => 'th_options',
    'capability' => 'edit_theme_options',
) );

// Misc. : Rounded Buttons
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_button_style',
    'label'       => esc_html__( 'Button Style', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'round',
    'priority'    => 10,
    'choices'     => array(
        'square'  => esc_attr__( 'Squared', 'bellevue' ),
        'round'   => esc_attr__( 'Rounded', 'bellevue' ),
    ),
    'output' => array(
        array(
            'element'  => '.simple-conversion form input[type=submit],.simple-conversion .with_frm_style input[type=submit],.search-form input',
            'property' => 'border-radius',
            'units'    => 'px',
            'value_pattern' => '5',
            'suffix' => '!important',
            'exclude' => array('round'),
        ),
        array(
            'element'  => '.nav-tabs > li > a, .frm_forms form input[type=text], .frm_forms form input[type=email], .frm_forms form input[type=url], .frm_forms form input[type=password], .frm_forms form input[type=number], .frm_forms form input[type=tel], .frm_style_formidable-style.with_frm_style input[type=text], .frm_style_formidable-style.with_frm_style input[type=password], .frm_style_formidable-style.with_frm_style input[type=email], .frm_style_formidable-style.with_frm_style input[type=number], .frm_style_formidable-style.with_frm_style input[type=url], .frm_style_formidable-style.with_frm_style input[type=tel], .frm_style_formidable-style.with_frm_style input[type=file], .frm_style_formidable-style.with_frm_style input[type=search], .woocommerce form input[type=text], .woocommerce form input[type=password], .woocommerce form input[type=email], .woocommerce form input[type=number], .woocommerce form input[type=url], .woocommerce form input[type=tel], .woocommerce form input[type=file], .woocommerce form input[type=search], .select2-container--default .select2-selection--single, .woocommerce form textarea, .woocommerce .woocommerce-info, .woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register',
            'property' => 'border-radius',
            'value_pattern' => '5px 5px 0 0',
            'exclude' => array('round'),
        ),
        array(
            'element'  => '.btn, .btn-cta, .btn-sm,.btn-group-sm > .btn, .btn-group-xs > .btn, .pager li > a,.pager li > span, .form-control, #respond input[type=submit], body .booked-modal button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce div.product form.cart .button, .search-form input, .search-submit, .th-accent, .headhesive--clone.banner[data-transparent-header=\'true\'] .th-accent, .elementor-widget-themo-info-card .th-info-card-wrap, .th-pkg-img img, .th-pkg-content, .th-pkg-info, .map-info, .mas-blog-post .post-inner, .mas-blog-post img, .flex-direction-nav a, .widget .tagcloud a, .woocommerce form select, .woocommerce-cart select, .woocommerce nav.woocommerce-pagination ul li',
            'property' => 'border-radius',
            'units'    => 'px',
            'value_pattern' => '5',
            'exclude' => array('round'),
        ),
        array(
            'element'  => 'form input[type=submit],.with_frm_style .frm_submit input[type=submit],.with_frm_style .frm_submit input[type=button],.frm_form_submit_style, .with_frm_style.frm_login_form input[type=submit], .widget input[type=submit],.widget .frm_style_formidable-style.with_frm_style input[type=submit], .th-port-btn, body #booked-profile-page input[type=submit], body #booked-profile-page button, body table.booked-calendar input[type=submit], body table.booked-calendar button, body .booked-modal input[type=submit], body .booked-modal button,.th-widget-area form input[type=submit],.th-widget-area .with_frm_style .frm_submit input[type=submit],.th-widget-area .widget .frm_style_formidable-style.with_frm_style input[type=submit]',
            'property' => 'border-radius',
            'units'    => 'px',
            'value_pattern' => '5',
            'exclude' => array('round'),
        ),
        array(
            'element'  => '.wpbs-form-form .wpbs-form-item input, .wpbs-form-form .wpbs-form-item select, .wpbs-form-form .wpbs-form-item textarea, .wpbs-form-form .wpbs-form-item .wpbs-form-submit',
            'property' => 'border-radius',
            'units'    => 'px',
            'value_pattern' => '5',
            'exclude' => array('round'),
            'suffix' => '!important',
        ),
    ),
) );

// Misc : Content Preloader
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_preloader',
    'label'       => esc_html__( 'Content Preloader', 'bellevue' ),
    'description'       => esc_html__( 'Enables preloader site wide.', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );


// Misc. : Smooth Scroll
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_smooth_scroll',
    'label'       => esc_html__( 'Smooth Scroll', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );


// Misc. : FBoxed mode vs full width
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_boxed_layout',
    'label'       => esc_html__( 'Boxed Layout', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Misc. : Boxed mode BG Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'th_boxed_bg_color', //themo_boxed_layout_background
    'label'       => esc_attr__( 'Background Color', 'bellevue' ),
    'section'     => 'misc',
    'default'     => '#FFF',
    'priority'    => 10,
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => 'body',
            'property' => 'background-color',
        ),

    ),
    'active_callback'  => array(
        array(
            'setting'  => 'themo_boxed_layout',
            'operator' => '==',
            'value'    => 1,
        ),
    )

) );

// Misc. : Boxed mode BG Image
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'image',
    'settings'    => 'th_boxed_bg_image',
    'label'       => esc_html__( 'Background Image', 'bellevue' ),
    'section'     => 'misc',
    'default'     => '',
    'priority'    => 10,
    'output' => array(
        array(
            'element'  => 'body',
            'property' => 'background-image',
        ),
        array(
            'element'  => 'body',
            'property' => 'background-attachment',
            'value_pattern' => 'fixed',
        ),
        array(
            'element'  => 'body',
            'property' => 'background-size',
            'value_pattern' => 'cover',
        ),

    ),
    'active_callback'  => array(
        array(
            'setting'  => 'themo_boxed_layout',
            'operator' => '==',
            'value'    => 1,
        ),
    )
) );

// Misc. : Enable Retina Find Replace script.
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_retinajs',
    'label'       => esc_html__( 'High-resolution/Retina Image Support', 'bellevue' ),
    'description' => esc_html__( 'Automatically serve up high-resolution images to devices that support them.', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Misc. : Retina Image Sizes Generator
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_retina_support',
    'label'       => esc_html__( 'High-resolution/Retina Image Generator', 'bellevue' ),
    'description' => esc_html__( 'Automatically generate high-resolution/retina image sizes (@2x) when uploaded to your Media Library.', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );


// Misc. : Custom Room CPT Slug
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'     => 'text',
    'settings' => 'themo_room_rewrite_slug',
    'label'       => esc_html__( 'Room Custom Slug', 'bellevue' ),
    'description'       => esc_html__( 'Optionally change the permalink slug for the Room custom post type. e.g.: "rides" or "packages"', 'bellevue' ),
    'section'     => 'misc',
    'priority' => 10,
) );

// Misc. : Event header switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'tribe_events_layout_show_header',
    'label'       => esc_html__( 'Events Header', 'bellevue' ),
    'description' => esc_html__( 'Show / Hide header for Events pages', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Misc. : Events Header Align
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'tribe_events_layout_header_float',
    'label'       => esc_html__( 'Events Header Position ', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'centered',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'centered'   => array(
            esc_attr__( 'Centered', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
    'active_callback'  => array(
        array(
            'setting'  => 'tribe_events_layout_show_header',
            'operator' => '==',
            'value'    => 1,
        ),
    )
) );

// Misc. : Events Sidebar Position
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'tribe_events_layout_sidebar',
    'label'       => esc_html__( 'Events Sidebar Position', 'bellevue' ),
    'section'     => 'misc',
    'default'     => 'right',
    'priority'    => 10,
    'choices'     => array(

        'left'   => array(
            esc_attr__( 'Left', 'bellevue' ),
        ),
        'full'   => array(
            esc_attr__( 'None', 'bellevue' ),
        ),
        'right'   => array(
            esc_attr__( 'Right', 'bellevue' ),
        ),

    ),
) );

// WIDGET SECTION
Bellevue_Kirki::add_section( 'th_widgets', array(
    'title'      => esc_attr__( 'Widgets', 'bellevue' ),
    'priority'   => 2,
    'panel'      => 'th_options',
    'capability' => 'edit_theme_options',
) );


// Footer : Footer Logo (Widget)
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'image',
    'settings'    => 'themo_footer_logo',
    'label'       => esc_html__( 'Footer Logo', 'bellevue' ),
    'description' => '<p>' . esc_html__( 'Upload the logo you would like to use in your footer widget.', 'bellevue' ) . '</p>' ,
    'section'     => 'th_widgets',
    'default'     => '',
    'priority'    => 10,
) );


// Footer : Footer Logo URL
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'     => 'text',
    'settings' =>  'themo_footer_logo_url',
    'label'       => esc_html__( 'Footer Logo Link', 'bellevue' ),
    'description' => esc_html__( 'e.g. mailto:stay@bellevue.com, /contact, http://google.com:', 'bellevue' ),
    'section'     => 'th_widgets',
    'priority' => 10,
) );


// Footer : Footer Logo URL
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'     => 'checkbox',
    'settings' =>  'themo_footer_logo_url_target',
    'label'       => esc_html__( 'Open Link in New Window', 'bellevue' ),
    'section'     => 'th_widgets',
    'priority' => 10,
) );

// Footer : Footer Social
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'repeater',
    'label'       => esc_html__( 'Social Media Accounts', 'bellevue' ),
    'description'        => esc_html__( 'For use with the "Social Icons" Widget. Add your social media accounts here. Use any', 'bellevue' ). ' Social icon (e.g.: fa fa-twitter). <a href="http://fontawesome.io/icons/" target="_blank">'.esc_html__( 'Full List Here', 'bellevue' ).'</a>',
    'section'     => 'th_widgets',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Social Icon', 'bellevue' ),
    ),
    'settings'    => 'themo_social_media_accounts',
    'default'     => array(
        array(
            'title' => esc_attr__( 'Facebook', 'bellevue' ),
            'themo_social_font_icon'  => 'fa fa-facebook',
            'themo_social_url'  => 'https://www.facebook.com',
            'themo_social_url_target'  => 1,
        ),
        array(
            'title' => esc_attr__( 'Twitter', 'bellevue' ),
            'themo_social_font_icon'  => 'fa fa-twitter',
            'themo_social_url'  => 'https://twitter.com',
            'themo_social_url_target'  => 1,
        ),
        array(
            'title' => esc_attr__( 'Instagram', 'bellevue' ),
            'themo_social_font_icon'  => 'fa fa-instagram',
            'themo_social_url'  => '#',
            'themo_social_url_target'  => 1,
        ),

    ),
    'fields' => array(
        'title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Name', 'bellevue' ),
            'default'     => '',
        ),
        'themo_social_font_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Icon', 'bellevue' ),
            'default'     => '',
        ),
        'themo_social_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Link', 'bellevue' ),
            'default'     => '',
        ),
        'themo_social_url_target' => array(
            'type'        => 'checkbox',
            'label'       => esc_attr__( 'Open Link in New Window', 'bellevue' ),
            'default'     => '',
        ),
    )
) );

// Footer : Footer Payments Accepted
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'repeater',
    'label'       => esc_html__( 'Payments Accepted', 'bellevue' ),
    'description' => esc_html__( 'For use with the "Payments Accepted" Widget. Add your accepted payments types here.', 'bellevue' ),
    'section'     => 'th_widgets',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Payment Info', 'bellevue' ),
    ),
    'settings'    => 'themo_payments_accepted',
    'default'     => array(
        array(
            'title' => esc_attr__( 'Visa', 'bellevue' ),
            'themo_payments_accepted_logo'  => '',
            'themo_payment_url'  => 'https://visa.com',
            'themo_payment_url_target'  => 1,
        ),
        array(
            'title' => esc_attr__( 'PayPal', 'bellevue' ),
            'themo_payments_accepted_logo'  => '',
            'themo_payment_url'  => 'https://paypal.com',
            'themo_payment_url_target'  => 1,
        ),
        array(
            'title' => esc_attr__( 'MasterCard', 'bellevue' ),
            'themo_payments_accepted_logo'  => '',
            'themo_payment_url'  => 'https://mastercard.com',
            'themo_payment_url_target'  => 1,
        ),
    ),
    'fields' => array(
        'title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Name', 'bellevue' ),
            'default'     => '',
        ),
        'themo_payments_accepted_logo' => array(
            'type'        => 'image',
            'label'       => esc_attr__( 'Logo', 'bellevue' ),
            'default'     => '',
        ),
        'themo_payment_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link', 'bellevue' ),
            'default'     => '',
        ),
        'themo_payment_url_target' => array(
            'type'        => 'checkbox',
            'label'       => esc_attr__( 'Open Link in New Window', 'bellevue' ),
            'default'     => '',
        ),
    )
) );

// Footer : Footer Contact Details
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'repeater',
    'label'       => esc_html__( 'Contact Details', 'bellevue' ),
    'description' => esc_html__( 'For use with the "Contact Info" Widget. Add your contact info here. Use any', 'bellevue' ). ' <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a> icon (e.g.: fa fa-twitter). <a href="http://fontawesome.io/icons/" target="_blank">'.esc_html__( 'Full List Here', 'bellevue' ).'</a>',
    'section'     => 'th_widgets',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Contact Info', 'bellevue' ),
    ),
    'settings'    => 'themo_contact_icons',
    'default'     => array(
        array(
            'title' => esc_attr__( 'contact@bellevue.com', 'bellevue' ),
            'themo_contact_icon'  => 'fa fa-envelope-open-o',
            'themo_contact_icon_url'  => 'mailto:contact@ourdomain.com',
            'themo_contact_icon_url_target'  => 1,
        ),
        array(
            'title' => esc_attr__( '1-800-222-4545', 'bellevue' ),
            'themo_contact_icon'  => 'fa fa-mobile',
            'themo_contact_icon_url'  => 'tel:800-222-4545',
            'themo_contact_icon_url_target'  => 1,
        ),
        array(
            'title' => esc_attr__( 'Location', 'bellevue' ),
            'themo_contact_icon'  => 'fa fa-map-o',
            'themo_contact_icon_url'  => '#',
            'themo_contact_icon_url_target'  => 0,
        ),

    ),
    'fields' => array(
        'title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Name', 'bellevue' ),
            'default'     => '',
        ),
        'themo_contact_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Icon', 'bellevue' ),
            'default'     => '',
        ),
        'themo_contact_icon_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link', 'bellevue' ),
            'default'     => '',
        ),
        'themo_contact_icon_url_target' => array(
            'type'        => 'checkbox',
            'label'       => esc_attr__( 'Open Link in New Window', 'bellevue' ),
            'default'     => '',
        ),
    )
) );



// FOOTER SECTION
Bellevue_Kirki::add_section( 'footer', array(
    'title'      => esc_attr__( 'Footer', 'bellevue' ),
    'priority'   => 2,
    'panel'      => 'th_options',
    'capability' => 'edit_theme_options',
) );



// Upper Footer : Widget Switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_footer_widget_switch',
    'label'       => esc_html__( 'Footer 1', 'bellevue' ),
    //'description' => esc_html__( 'Show / hide upper footer widgets area', 'bellevue' ),
    'section'     => 'footer',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Footer : Footer Columns
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_footer_columns',
    'label'       => esc_html__( 'How many columns?', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '4',
    'priority'    => 10,
    'choices'     => array(
        '1'   => esc_attr__( '1 Column', 'bellevue' ),
        '2' => esc_attr__( '2 Columns', 'bellevue' ),
        '3'  => esc_attr__( '3 Columns', 'bellevue' ),
        '4'  => esc_attr__( '4 Columns', 'bellevue' ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer : Title Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer_widget_title_colour',
    'label'       => __( 'Title', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '#FFFFFF',
    'output' => array(
        array(
            'element'  => '.th-upper-footer h1.widget-title, .th-upper-footer h2.widget-title, 
            .th-upper-footer h3.widget-title, .th-upper-footer h4.widget-title, .th-upper-footer h5.widget-title,
            .th-upper-footer h6.widget-title, .th-upper-footer a:hover',
            'property' => 'color',
            'exclude' => array( false )
        ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer : Widget Title Underland
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_footer_remove_title_underline',
    'label'       => esc_html__( 'Underline', 'bellevue' ),
    'section'     => 'footer',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
    'output' => array(
        array(
            'element'  => '.footer .widget-title',
            'property' => 'border-bottom',
            'value_pattern' => 'none',
            'exclude' => array( true )
        ),
        array(
            'element'  => '.footer .widget-title',
            'property' => 'padding-bottom',
            'value_pattern' => '0px',
            'exclude' => array( true )
        ),
        array(
            'element'  => '.footer .widget-title, .footer h3.widget-title',
            'property' => 'padding-bottom',
            'value_pattern' => '0px',
            'exclude' => array( true ),
            'suffix' => '!important',
        ),
        array(
            'element'  => '.footer .widget-title, .footer h3.widget-title',
            'property' => 'margin-bottom',
            'value_pattern' => '18px',
            'exclude' => array( true )
        ),
        array(
            'element'  => '.footer .widget-title:after',
            'property' => 'display',
            'value_pattern' => 'none',
            'exclude' => array( true )
        ),
        //
    ),
    //padding-bottom: 20px
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );



// Footer : Text Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer_widget_text_colour',
    'label'       => __( 'Text', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '#d2d2d2',
    'output' => array(
        array(
            'element'  => '.th-upper-footer p, .th-upper-footer a, .th-upper-footer ul li, .th-upper-footer ol li, .th-upper-footer .soc-widget i',
            'property' => 'color',
            'exclude' => array( false )
        ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );







// Footer : Background Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer_background_colour',
    'label'       => __( 'Background', 'textdomain' ),
    'section'     => 'footer',
    'default'     => '#292e31',
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(

        array(
            'element'  => '.th-upper-footer',
            'property' => 'background',
        ),

    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer : Accent Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer_widget_border_colour',
    'label'       => __( 'Accent', 'bellevue' ),
    'section'     => 'footer',
    'default'     => 'rgba(255,255,255,0.12)',
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => '.footer input[type=text], .footer input[type=email],
            .footer input[type=url], .footer input[type=password],
            .footer input[type=number], .footer input[type=tel],
            .footer textarea, .footer select, .th-payment-no-img',
            'property' => 'border-color',
            'exclude' => array( false ),
            'suffix' => '!important',
        ),
        array(
            'element'  => '.footer .meta-border, .footer ul li, .footer .widget ul li,
            .footer .widget-title,
            .footer .widget.widget_categories li a, .footer .widget.widget_pages li a, .footer .widget.widget_nav_menu li a',
            'property' => 'border-bottom-color',
            'exclude' => array( false )
        ),
        array(
            'element'  => '.footer .widget-title:after',
            'property' => 'background-color',
            'exclude' => array( false )
        ),
        //

    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer 2 : Widget Switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_footer2_widget_switch',
    'label'       => esc_html__( 'Footer 2', 'bellevue' ),
    //'description' => esc_html__( 'Show / hide lower footer widgets area', 'bellevue' ),
    'section'     => 'footer',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Footer : Widget Title Underland
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_footer2_divder',
    'label'       => esc_html__( 'Divider', 'bellevue' ),
    //'description' => esc_html__( 'Show / Hide section divider', 'bellevue' ),
    'section'     => 'footer',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
    'output' => array(
        array(
            'element'  => '.th-lower-footer .th-separator',
            'property' => 'border-top',
            'value_pattern' => '1px solid #dcdcdc',
            'exclude' => array( false )
        ),
        array(
            'element'  => '.th-lower-footer .th-widget-area',
            'property' => 'padding-top',
            'value_pattern' => '50px',
            'exclude' => array( false )
        ),
        array(
            'element'  => '.th-lower-footer',
            'property' => 'padding-top',
            'value_pattern' => '0px',
            'exclude' => array( false ),
            'suffix' => '!important'
        ),
    ),
    //padding-bottom: 20px
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer2_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Lower Footer : Text Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer2_divider_colour',
    'label'       => __( 'Divider Color', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '#888888',
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => '.th-lower-footer .th-separator',
            'property' => 'border-top-color',
            'exclude' => array( false )
        ),

    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer2_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer 2 : Footer Columns
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'radio',
    'settings'    => 'themo_footer2_columns',
    'label'       => esc_html__( 'How many columns?', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '2',
    'priority'    => 10,
    'choices'     => array(
        '1'   => esc_attr__( '1 Column', 'bellevue' ),
        '2' => esc_attr__( '2 Columns', 'bellevue' ),
        '3'  => esc_attr__( '3 Columns', 'bellevue' ),
        '4'  => esc_attr__( '4 Columns', 'bellevue' ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer2_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer : Title Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer2_widget_title_colour',
    'label'       => __( 'Title', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '#FFFFFF',
    'output' => array(
        array(
            'element'  => '.th-lower-footer h1.widget-title, .th-lower-footer h2.widget-title, .th-lower-footer h3.widget-title, .th-lower-footer h4.widget-title,
             .th-lower-footer h5.widget-title, .th-lower-footer h6.widget-title, .th-lower-footer a:hover',
            'property' => 'color',
            'exclude' => array( false )
        ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer2_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer : Text Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer2_widget_text_colour',
    'label'       => __( 'Text', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '#d2d2d2',
    'output' => array(
        array(
            'element'  => '.th-lower-footer p, .th-lower-footer a, .th-lower-footer ul li, .th-lower-footer ol li, .th-lower-footer .soc-widget i',
            'property' => 'color',
            'exclude' => array( false )
        ),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer2_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );



// Footer : Background Colour
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'color',
    'settings'    => 'themo_footer2_background_colour',
    'label'       => __( 'Background', 'bellevue' ),
    'section'     => 'footer',
    'default'     => '#212E31',
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(

        array(
            'element'  => '.th-lower-footer',
            'property' => 'background',
        ),

    ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer2_widget_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// Footer Copyright : Widget Switch
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_footer_copyright_switch',
    'label'       => esc_html__( 'Footer Copyright', 'bellevue' ),
    'section'     => 'footer',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Footer : Copyright
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'     => 'textarea',
    'settings' => 'themo_footer_copyright',
    'label'       => esc_html__( 'Copyright', 'bellevue' ),
    'section'     => 'footer',
    'priority' => 10,
    //'default'     => esc_html__( '&copy; Bellevue Room Co.', 'bellevue' ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_copyright_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );


// Footer : Credit
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'     => 'textarea',
    'settings' => 'themo_footer_credit',
    'label'       => esc_html__( 'Credit', 'bellevue' ),
    'section'     => 'footer',
    'priority' => 10,
    'default' => __( 'Made with <i class="fa fa-heart-o"></i> by <a href="http://themovation.com">Themovation</a>', 'bellevue' ),
    'active_callback'    => array(
        array(
            'setting'  => 'themo_footer_copyright_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

// START PLUGINS SECTION
Bellevue_Kirki::add_section('plugins', array(
    'title' => esc_attr__('Plugins', 'bellevue'),
    'priority' => 2,
    'panel' => 'th_options',
    'capability' => 'edit_theme_options',
));

Bellevue_Kirki::add_field('bellevue_theme', array(
    'type' => 'custom',
    'settings' => 'themo_plugins_heading',
    'label' => esc_html__('Enabling bundled plugins', 'bellevue'),
    'section' => 'plugins',
    'priority' => 10,
    'default' => '<div class="th-theme-support">' . __('1 - Enable any of the listed bundled plugins.</p></p>2 - Publish your changes</p><p>3 - Follow the admin notice instructions on the WordPress dashboard to install.</p>', 'bellevue') . '</div>',
));


// Plugins : Hotel Booking
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_hotel_booking',
    'label'       => esc_html__( 'Hotel Booking', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Hotel Booking WooCommerce Payments
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_hotel_booking_woocommerce_payments',
    'label'       => esc_html__( 'Hotel Booking WooCommerce Payments', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : WooCommerce
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_woocommerce',
    'label'       => esc_html__( 'WooCommerce', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Slider Revolution
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_revslider',
    'label'       => esc_html__( 'Slider Revolution', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Groovy Menu
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_groovy_menu',
    'label'       => esc_html__( 'Groovy Menu', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Master Slider Pro
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_masterslider',
    'label'       => esc_html__( 'Master Slider Pro', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'off',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Formidable
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_formidable',
    'label'       => esc_html__( 'Formidable Forms', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Simple Page Ordering
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_simple_page_ordering',
    'label'       => esc_html__( 'Simple Page Ordering', 'bellevue' ),
    'description' => esc_html__( 'Recommended for drag and drop sort ordering of custom post types.', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// Plugins : Widget Logic
Bellevue_Kirki::add_field( 'bellevue_theme', array(
    'type'        => 'switch',
    'settings'    => 'themo_tgmpa_widget_logic',
    'label'       => esc_html__( 'Widget Logic', 'bellevue' ),
    'description' => esc_html__( 'Recommended for displaying/hiding widgets on specific pages and areas.', 'bellevue' ),
    'section'     => 'plugins',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'bellevue' ),
        'off' => esc_attr__( 'Disable', 'bellevue' ),
    ),
) );

// END PLUGINS SECTION

if ( defined('ENVATO_HOSTED_SITE') ) {
    // this is an envato hosted site so Skip
}else {
// SUPPORT SECTION
    Bellevue_Kirki::add_section('support', array(
        'title' => esc_attr__('Theme Support', 'bellevue'),
        'priority' => 2,
        'panel' => 'th_options',
        'capability' => 'edit_theme_options',
    ));

// Support : Custom
    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'custom',
        'settings' => 'themo_help_heading',
        'label' => esc_html__('Yes, we offer support', 'bellevue'),
        'section' => 'support',
        'priority' => 10,
        'default' => '<div class="th-theme-support">' . __('We want to make sure this is a great experience for you.</p> <p > If you have any questions, concerns or comments please contact us through the links below.', 'bellevue') . '</div>',
    ));

    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'custom',
        'settings' => 'themo_help_support_includes',
        'label' => esc_html__('Theme support includes', 'bellevue'),
        'section' => 'support',
        'priority' => 10,
        'default' => '<div class="th-theme-support">' . __('<ul><li class="dashicons-before dashicons-yes">Availability of the author to answer questions</li><li class="dashicons-before dashicons-yes">Answering technical questions about item\'s features</li><li class="dashicons-before dashicons-yes">Assistance with reported bugs and issues</li><li class="dashicons-before dashicons-yes">Help with included 3rd party assets</li></ul>', 'bellevue') . '</div>',
    ));

    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'custom',
        'settings' => 'themo_help_support_not_includes',
        'label' => esc_html__('However, theme support does not include:', 'bellevue'),
        'section' => 'support',
        'priority' => 10,
        'default' => '<div class="th-theme-support">' . __('<ul><li class="dashicons-before dashicons-no">Customization services</li><li class="dashicons-before dashicons-no">Installation services</li></ul>', 'bellevue') . '</div>',
    ));

    Bellevue_Kirki::add_field('bellevue_theme', array(
        'type' => 'custom',
        'settings' => 'themo_help_support_links',
        'label' => esc_html__('Where to get help', 'bellevue'),
        'section' => 'support',
        'priority' => 10,
        'default' => '<div class="th-theme-support">' . sprintf(__('<p class="dashicons-before dashicons-admin-links"> Check out our <a href="%1$s" target="_blank">helpful guides</a>, <a href="%2$s" target="_blank">online documentation</a> and <a href="%3$s" target="_blank">rockstar support</a>.</p>', 'bellevue'), 'http://themovation.helpscoutdocs.com/', 'http://themovation.helpscoutdocs.com/', 'https://themovation.ticksy.com/') . '</div>',
    ));
}