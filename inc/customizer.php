<?php
/**
 * jasmin Theme Customizer
 *
 * @package jasmin
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jasmin_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
    // Add Sections

    class Customize_Number_Control extends WP_Customize_Control {
        public $type = 'number';
     
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="number" name="quantity" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;">
            </label>
            <?php
        }
    }
    
    class Customize_CustomCss_Control extends WP_Customize_Control {
        public $type = 'custom_css';
     
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea style="width:100%; height:150px;" <?php $this->link(); ?>><?php echo $this->value(); ?></textarea>
            </label>
            <?php
        }
    }
    
    if (class_exists('WP_Customize_Control')) {
        class WP_Customize_Category_Control extends WP_Customize_Control {
            
            public function render_content() {
                $dropdown = wp_dropdown_categories(
                    array(
                        'name'              => '_customize-dropdown-categories-' . $this->id,
                        'echo'              => 0,
                        'show_option_none'  => __( '&mdash; Select &mdash;', 'jasmin' ),
                        'option_none_value' => '0',
                        'selected'          => $this->value(),
                    )
                );
     
                // Hackily add in the data link parameter.
                $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
     
                printf(
                    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                    $this->label,
                    $dropdown
                );
            }
        }
    }
    
    /* General Settings */
    $wp_customize->add_section(
        'general_settings',
        array(
            'title' => __( 'General Settings', 'jasmin' ),
            'description' => __( 'Some common settings for entire site', 'jasmin' ),
            'priority' => 30,
        )
    );
        
	// logo
    $wp_customize->add_setting(
        'jasmin_logo', array (
			'sanitize_callback' => 'esc_url_raw'
		)
    );
    
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'jasmin_logo',
            array(
                'label' => __( 'Upload Logo', 'jasmin' ),
                'section' => 'general_settings',
                'settings' => 'jasmin_logo'
            )
        )
    );
    
	
	//Full Width Page Layout
    $wp_customize->add_setting (
        'jasmin_full_width_layout',
        array(
            'default'     => 'sidebar',
			'sanitize_callback' => 'jasmin_sanitize_layout'
        )
    );
    
    $wp_customize->add_control (
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_full_width_layout',
            array(
                'label'          => __( 'Website Layout', 'jasmin' ),
                'description' => __( 'Does not work with Pages, for pages use Template setting', 'jasmin' ),
                'section'        => 'general_settings',
                'settings'       => 'jasmin_full_width_layout',
                'type'           => 'radio',
                'choices'        => array(
                    'sidebar'   => 'Sidebar Layout',
                    'full'  => 'Full Width Layout',
                )
            )
        )
    );
    
	/* Top Bar */
    $wp_customize->add_section(
        'top_bar',
        array(
            'title' => __( 'Top Bar Settings', 'jasmin' ),
            'priority' => 31,
        )
    );
    
    //Disable Search
    $wp_customize->add_setting(
        'jasmin_topbar_search',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
	
	
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_topbar_search',
            array(
                'label'      => __( 'Disable Top Bar Search', 'jasmin' ),
                'section'    => 'top_bar',
                'settings'   => 'jasmin_topbar_search',
                'type'       => 'checkbox'
            )
        )
    );
	
	/* Post Settings */
    $wp_customize->add_section(
        'post_settings',
        array(
            'title' => __( 'Post Settings', 'jasmin' ),
            'priority' => 32,
        )
    );
    
    //Posts Category
    $wp_customize->add_setting(
        'jasmin_post_cat',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_post_cat',
            array(
                'label'      => __( 'Hide Category', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_post_cat',
                'type'       => 'checkbox'
            )
        )
    );
	
	//Posts Date
    $wp_customize->add_setting(
        'jasmin_post_date',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_post_date',
            array(
                'label'      => __( 'Hide Date and Author', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_post_date',
                'type'       => 'checkbox'
            )
        )
    );
    
	//Posts Tags
    $wp_customize->add_setting(
        'jasmin_post_tag',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_post_tag',
            array(
                'label'      => __( 'Hide Tags', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_post_tag',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Share Buttons
    $wp_customize->add_setting(
        'jasmin_share_buttons',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_share_buttons',
            array(
                'label'      => __( 'Hide Share Buttons', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_share_buttons',
                'type'       => 'checkbox'
            )
        )
    );
	
	
    //Prev/ Next Post Links
    $wp_customize->add_setting(
        'jasmin_pn_links',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_pn_links',
            array(
                'label'      => __( 'Hide Prev/ Next Post Links', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_pn_links',
                'type'       => 'checkbox'
            )
        )
    );
	
	//Author Box
    $wp_customize->add_setting(
        'jasmin_author_box',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_author_box',
            array(
                'label'      => __( 'Hide Author Box', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_author_box',
                'type'       => 'checkbox'
            )
        )
    );
	
	//Post Format Icons
    $wp_customize->add_setting(
        'jasmin_post_format',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_post_format',
            array(
                'label'      => __( 'Hide Post Format Icons', 'jasmin' ),
                'section'    => 'post_settings',
                'settings'   => 'jasmin_post_format',
                'type'       => 'checkbox'
            )
        )
    );
    
    /* Page Settings */
    $wp_customize->add_section(
        'page_settings',
        array(
            'title' => __( 'Page Settings', 'jasmin' ),
            'priority' => 33,
        )
    );
    
    //page Share Buttons
    $wp_customize->add_setting(
        'jasmin_page_share_buttons',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_page_share_buttons',
            array(
                'label'      => __( 'Hide Page Share Buttons', 'jasmin' ),
                'section'    => 'page_settings',
                'settings'   => 'jasmin_page_share_buttons',
                'type'       => 'checkbox'
            )
        )
    );
    
    /* Footer Settings */
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title' => __( 'Footer Settings', 'jasmin' ),
            'priority' => 34,
        )
    );
    
    //Footer Social Links
    $wp_customize->add_setting(
        'jasmin_footer_social',
        array(
            'default'     => false,
			'sanitize_callback' => 'jasmin_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_footer_social',
            array(
                'label'      => __( 'Hide Footer Social', 'jasmin' ),
                'section'    => 'footer_settings',
                'settings'   => 'jasmin_footer_social',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Copyright Text
	$wp_customize->add_setting(
        'jasmin_copyright_text',
        array(
            'default'     => 'Copyright 2016 Kagai.me. All Rights Reserved.',
			'transport' => 'postMessage',
			'sanitize_callback' => 'jasmin_crt_sanitize_text'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jasmin_copyright_text',
            array(
                'label'      => __( 'Copyright Text', 'jasmin' ),
                'section'    => 'footer_settings',
                'settings'   => 'jasmin_copyright_text',
				'type' => 'text'			
            )
        )
    );
    
    /* Custom CSS Section */
    $wp_customize->add_section( 'jasmin_section_custom_code' , array(
        'title'      => __( 'Custom Code', 'jasmin' ),
        'description'=> __( 'Enter your custom CSS code, to overwrite the theme CSS.', 'jasmin' ),
        'priority'   => 200,
    ) );
    
    // Custom CSS
    $wp_customize->add_setting (
        'jasmin_custom_css'
    );
    
    $wp_customize->add_control(
        new Customize_CustomCss_Control(
            $wp_customize,
            'jasmin_custom_css',
            array(
                'label'      => __( 'Custom CSS', 'jasmin' ),
                'section'    => 'jasmin_section_custom_code',
                'settings'   => 'jasmin_custom_css',
                'type'       => 'textarea',
            )
        )
    );
    
    // Color Settings
   $wp_customize->add_section( 'jasmin_section_top_bar_colors' , array(
        'title'      => __( 'Colors: Top Bar', 'jasmin' ),
        'description'=> __( 'Enter your custom colors for the top bar section', 'jasmin' ),
        'priority'   => 35,
    ) );
   
   // Color: Theme
   $wp_customize->add_setting(
        'jasmin_theme_color',
        array(
            'default'     => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_theme_color',
            array(
                'label'      =>  __( 'Theme Color', 'jasmin' ),
                'section'    => 'colors',
                'settings'   => 'jasmin_theme_color'
            )
        )
    );
    
    // Color: Text Logo
   $wp_customize->add_setting(
        'jasmin_text_logo_color',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_text_logo_color',
            array(
                'label'      =>  __( 'Text Logo Color', 'jasmin' ),
                'section'    => 'colors',
                'settings'   => 'jasmin_text_logo_color'
            )
        )
    );
    
    // Color: Theme Link
   $wp_customize->add_setting(
        'jasmin_theme_link_color',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_theme_link_color',
            array(
                'label'      =>  __( 'Theme Link Color', 'jasmin' ),
                'section'    => 'colors',
                'settings'   => 'jasmin_theme_link_color'
            )
        )
    );
    
    // Color: Theme Border Color
   $wp_customize->add_setting(
        'jasmin_theme_border_color',
        array(
            'default'     => '#ffcc33',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_theme_border_color',
            array(
                'label'      =>  __( 'Theme Border Color', 'jasmin' ),
                'section'    => 'colors',
                'settings'   => 'jasmin_theme_border_color'
            )
        )
    );
    
    // Color: Top Bar - Background
   $wp_customize->add_setting(
        'jasmin_topbar_bg_color',
        array(
            'default'     => '#ffffcc',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_bg_color',
            array(
                'label'      => __( 'Menu Background Color ', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_bg_color'
            )
        )
    );
    
    // Color: Top Bar
   $wp_customize->add_setting(
        'jasmin_topbar_menu_text_color',
        array(
            'default'     => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_menu_text_color',
            array(
                'label'      => __( 'Menu Text Color', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_menu_text_color'
            )
        )
    );
    
    // Color: Top Bar - Hover
   $wp_customize->add_setting(
        'jasmin_topbar_menu_text_color_hover',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_menu_text_color_hover',
            array(
                'label'      => __( 'Menu Text Color (Hover)', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_menu_text_color_hover'
            )
        )
    );
    
    // Color: Top Bar - Focus
   $wp_customize->add_setting(
        'jasmin_topbar_menu_text_color_focus',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_menu_text_color_focus',
            array(
                'label'      => __( 'Menu Text Color (Focus)', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_menu_text_color_focus'
            )
        )
    );
    
    // Color: Top Bar - Menu Dropdown Background
   $wp_customize->add_setting(
        'jasmin_topbar_dd_menu_bg_color',
        array(
            'default'     => '#ffff99',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_dd_menu_bg_color',
            array(
                'label'      => __( 'Dropdown Background Color', 'jasmin' ),
                'description'=> __( 'Background color shown on menu dropdown', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_dd_menu_bg_color'
            )
        )
    );
    
    // Color: Top Bar - Menu Dropdown Hover
   $wp_customize->add_setting(
        'jasmin_topbar_dd_menu_hover_color',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_dd_menu_hover_color',
            array(
                'label'      => __( 'Dropdown Hover & Focus Color', 'jasmin' ),
                'description'=> __( 'Color shown on menu links on dropdown on Hover & Focus', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_dd_menu_hover_color'
            )
        )
    );
    
    // Color: Top Bar - Menu Dropdown Hover & Focus Background
   $wp_customize->add_setting(
        'jasmin_topbar_dd_menu_hf_bg_color',
        array(
            'default'     => '#ffff66',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_dd_menu_hf_bg_color',
            array(
                'label'      => __( 'Dropdown Hover Background Color', 'jasmin' ),
                'description'=> __( 'Background color shown on menu links on dropdown on Hover & Focus', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_dd_menu_hf_bg_color'
            )
        )
    );
    
    // Color: Top Bar - Current Page, Menu & Ancestor
   $wp_customize->add_setting(
        'jasmin_topbar_current_pma_color',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_current_pma_color',
            array(
                'label'      => __( 'Current Page Menu Link Color', 'jasmin' ),
                'description'=> __( 'Color of the link of the current page, menu item and ancestor menu', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_current_pma_color'
            )
        )
    );
    
    // Color: Top Bar - Mobile Dropdown Background
   $wp_customize->add_setting(
        'jasmin_topbar_mobile_dd_bg',
        array(
            'default'     => '#ffff99',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_mobile_dd_bg',
            array(
                'label'      => __( 'Mobile Menu Dropdown Background Color ', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_mobile_dd_bg'
            )
        )
    );
    
    // Color: Top Bar - Search Icon
   $wp_customize->add_setting(
        'jasmin_topbar_search_icon',
        array(
            'default'     => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_topbar_search_icon',
            array(
                'label'      => __( 'Search Icon Color', 'jasmin' ),
                'section'    => 'jasmin_section_top_bar_colors',
                'settings'   => 'jasmin_topbar_search_icon'
            )
        )
    );
    
    /* Sidebar Color Settings */
    $wp_customize->add_section( 'jasmin_section_sidebar_colors' , array(
        'title'      => __( 'Colors: Sidebar', 'jasmin' ),
        'description'=> __( 'Enter your custom colors for the sidebar section', 'jasmin' ),
        'priority'   => 36,
    ) );
    
    // Color: Sidebar - Widget Title
   $wp_customize->add_setting(
        'jasmin_sidebar_widget_title',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_sidebar_widget_title',
            array(
                'label'      => __( 'Widget Title Color', 'jasmin' ),
                'section'    => 'jasmin_section_sidebar_colors',
                'settings'   => 'jasmin_sidebar_widget_title'
            )
        )
    );
    
    // Color: Sidebar - Widget Title Border bottom
   $wp_customize->add_setting(
        'jasmin_sidebar_widget_title_border',
        array(
            'default'     => '#ffcc33',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_sidebar_widget_title_border',
            array(
                'label'      => __( 'Widget Title Border Color', 'jasmin' ),
                'section'    => 'jasmin_section_sidebar_colors',
                'settings'   => 'jasmin_sidebar_widget_title_border'
            )
        )
    );
    
     // Color: Sidebar - Widget Link
   $wp_customize->add_setting(
        'jasmin_sidebar_widget_link',
        array(
            'default'     => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_sidebar_widget_link',
            array(
                'label'      => __( 'Widget Title Border Color', 'jasmin' ),
                'section'    => 'jasmin_section_sidebar_colors',
                'settings'   => 'jasmin_sidebar_widget_link'
            )
        )
    );
    
    /* Footer Color Settings */
    $wp_customize->add_section( 'jasmin_section_footer_colors' , array(
        'title'      => __( 'Colors: Footer', 'jasmin' ),
        'description'=> __( 'Enter your custom colors for the footer section', 'jasmin' ),
        'priority'   => 37,
    ) );
    
    // Color: Footer - Social Link
   $wp_customize->add_setting(
        'jasmin_footer_social_link',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_footer_social_link',
            array(
                'label'      => __( 'Social Link Color', 'jasmin' ),
                'section'    => 'jasmin_section_footer_colors',
                'settings'   => 'jasmin_footer_social_link'
            )
        )
    );
    
    // Color: Footer - Social Link Background Hover
   $wp_customize->add_setting(
        'jasmin_footer_social_link_bg_hover',
        array(
            'default'     => '#cc6633',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_footer_social_link_bg_hover',
            array(
                'label'      => __( 'Hover Background', 'jasmin' ),
                'description'=> __( 'Background color on social icon hover', 'jasmin' ),
                'section'    => 'jasmin_section_footer_colors',
                'settings'   => 'jasmin_footer_social_link_bg_hover'
            )
        )
    );
    
    // Color: Footer - Social Link Text Hover
   $wp_customize->add_setting(
        'jasmin_footer_social_link_txt_hover',
        array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'jasmin_footer_social_link_txt_hover',
            array(
                'label'      => __( 'Text Hover Color', 'jasmin' ),
                'section'    => 'jasmin_section_footer_colors',
                'settings'   => 'jasmin_footer_social_link_txt_hover'
            )
        )
    );
}
add_action( 'customize_register', 'jasmin_customize_register' );

/**
 * Sanitize layout options
 */
function jasmin_sanitize_layout( $value ) {
    if ( ! in_array( $value, array( 'sidebar', 'full' ) ) )
        $value = 'sidebar';
     return $value;
}

/**
 * Sanitize checkbox
 */
function jasmin_sanitize_checkbox( $value ) {
    if ( $value == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize copyright text
 */
function jasmin_crt_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Binds CSS Styles to WP Header
 */
 
function jasmin_customizer_css() {
    ?>
        <style type="text/css">
            <?php if(get_theme_mod( 'jasmin_theme_color' )) : ?>
                body,
                button,
                input,
                select,
                textarea {
                    color: <?php echo get_theme_mod( 'jasmin_theme_color' ); ?>;
                }
            <?php endif; ?>
            
            <?php if(get_theme_mod( 'jasmin_text_logo_color' )) : ?>
                .site-title a {
                    color: <?php echo get_theme_mod( 'jasmin_text_logo_color' ); ?>;
                }
            <?php endif; ?>
            
            <?php if(get_theme_mod( 'jasmin_theme_link_color' )) : ?>
                .entry-content a, 
                .read-more a,
                .social-share a,
                .entry-content a:visited,
                .page .social-share a i, 
                .single-post .social-share a i,
                .nav-links a,
                .social-share a i:hover {
                    color: <?php echo get_theme_mod( 'jasmin_theme_link_color' ); ?>;
                }
                
                .social-share a i {
                    border: 1px solid <?php echo get_theme_mod( 'jasmin_theme_link_color' ); ?>;
                }
            <?php endif; ?>
            
            <?php if(get_theme_mod( 'jasmin_topbar_bg_color' )) : ?>
                #top-header {
                        background: <?php echo get_theme_mod( 'jasmin_topbar_bg_color' ); ?>;
                }
            <?php endif; ?>
            
            <?php if(get_theme_mod( 'jasmin_theme_border_color' )) : ?>
                blockquote,
                .post-nav-box,
                .continue-reading {
                    border-color: <?php echo get_theme_mod( 'jasmin_theme_border_color' ); ?>;
                }
            <?php endif; ?>
            
            <?php if ( !is_page(  get_theme_mod( 'jasmin_full_width_layout') == 'full'  ) && get_theme_mod( 'jasmin_full_width_layout') == 'full' ) : ?>
                .content-area {
                    width:100%;
                    padding: 0;
                    margin: 0;
                }
                
                .site-footer {
                    clear: both;
                    width: 100%;
                }
                
                .entry-header,
                .entry-content,
                .entry-meta,
                .entry-footer,
                .tag-links,
                .post-navigation,
                .comments-area,
                .paging-navigation {
                    position: relative;
                }
                
                .form-allowed-tags,
                textarea {
                    width: 70%;
                }
            <?php endif; ?>
            
            <?php if ( get_theme_mod('jasmin_post_format') ) : ?>
            
                .post-format-content {
                    border: none;
                    float: none;
                    padding-left: 0;
                    width: 100%;
                }
                
                .format-video .entry-content:before,
                .format-audio .entry-content:before,
                .format-image .entry-content:before,
                .format-chat  .entry-content:before,
                .format-status  .entry-content:before,
                .format-link  .entry-content:before,
                .format-quote  .entry-content:before,
                .format-aside  .entry-content:before {
                    display: none;
                }            
                            
            <?php endif; ?>
            
            <?php if(get_theme_mod( 'jasmin_custom_css' )) : ?>
                <?php echo get_theme_mod( 'jasmin_custom_css' ); ?>
            <?php endif; ?>
            
            <?php if(get_theme_mod( 'jasmin_topbar_menu_text_color' )) : ?>
                .main-navigation a {
                    color: <?php echo get_theme_mod( 'jasmin_topbar_menu_text_color' ); ?>;
                }
            <?php endif; ?>
             
             <?php if(get_theme_mod( 'jasmin_topbar_menu_text_color_hover' )) : ?>
                .main-navigation li:hover > a {
                    color: <?php echo get_theme_mod( 'jasmin_topbar_menu_text_color_hover' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_menu_text_color_focus' )) : ?>
                .main-navigation li.focus > a {
                    color: <?php echo get_theme_mod( 'jasmin_topbar_menu_text_color_focus' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_dd_menu_bg_color' )) : ?>
                .main-navigation ul ul {
                    background: <?php echo get_theme_mod( 'jasmin_topbar_dd_menu_bg_color' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_dd_menu_hover_color' )) : ?>
                .main-navigation ul ul a:hover,
                .main-navigation ul ul a:focus {
                    color: <?php echo get_theme_mod( 'jasmin_topbar_dd_menu_hover_color' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_dd_menu_hf_bg_color' )) : ?>
                .main-navigation ul ul a:focus,
                .main-navigation ul ul a:hover {
                    background: <?php echo get_theme_mod( 'jasmin_topbar_dd_menu_hf_bg_color' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_current_pma_color' )) : ?>
                .main-navigation .current_page_item > a,
                .main-navigation .current-menu-item > a,
                .main-navigation .current_page_ancestor > a,
                .main-navigation .current-menu-ancestor > a {
                    color: <?php echo get_theme_mod( 'jasmin_topbar_current_pma_color' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_mobile_dd_bg' )) : ?>
                .main-navigation.toggled {
                    background: <?php echo get_theme_mod( 'jasmin_topbar_mobile_dd_bg' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_topbar_search_icon' )) : ?>
                .search-box-wrapper .fa-search {
                    color: <?php echo get_theme_mod( 'jasmin_topbar_search_icon' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_sidebar_widget_title' )) : ?>
                .widget-title {
                    color: <?php echo get_theme_mod( 'jasmin_sidebar_widget_title' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_sidebar_widget_title_border' )) : ?>
                .widget-title {
                    border-color: <?php echo get_theme_mod( 'jasmin_sidebar_widget_title_border' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_sidebar_widget_link' )) : ?>
                .widget a {
                    color: <?php echo get_theme_mod( 'jasmin_sidebar_widget_link' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_footer_social_link' )) : ?>
                .menu-social a {
                    color: <?php echo get_theme_mod( 'jasmin_footer_social_link' ); ?>;
                }
                
                .menu-social li a:before {
                    border-color: <?php echo get_theme_mod( 'jasmin_footer_social_link' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_footer_social_link_bg_hover' )) : ?>
                .menu-social li a:hover::before {
                    background: <?php echo get_theme_mod( 'jasmin_footer_social_link_bg_hover' ); ?>;
                }
            <?php endif; ?>
            <?php if(get_theme_mod( 'jasmin_footer_social_link_txt_hover' )) : ?>
                .menu-social li a:hover::before {
                    color: <?php echo get_theme_mod( 'jasmin_footer_social_link_txt_hover' ); ?>;
                }
            <?php endif; ?>
        </style>
    <?php
}
add_action( 'wp_head', 'jasmin_customizer_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jasmin_customize_preview_js() {
	wp_enqueue_script( 'jasmin_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'jasmin_customize_preview_js' );
