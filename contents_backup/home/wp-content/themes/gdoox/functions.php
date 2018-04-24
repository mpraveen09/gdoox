<?php
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles',99);
function child_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/custom.css', array( $parent_style ));
}
if ( get_stylesheet() !== get_template() ) {
    add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
         update_option( 'theme_mods_' . get_template(), $value );
         return $old_value; // prevent update to child theme mods
    }, 10, 2 );
    add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
        return get_option( 'theme_mods_' . get_template(), $default );
    } );
}


add_action('widgets_init', 'kyma_widget_addons');
function kyma_widget_addons()
{
    /*sidebar*/

    register_sidebar(array(
        'name'          => __('Top Widget Area', 'kyma'),
        'id'            => 'top-widget',
        'description'   => __('Top Widget Area', 'kyma'),
        'before_widget' => '<div class="footer-widget-col col-md-' . $col . '">
                                <div class="footer_row">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="footer_title">',
        'after_title'   => '</h6>',
    ));
    
    register_sidebar(array(
        'name'          => __('FAQ - Sidebar Widget Area', 'kyma'),
        'id'            => 'faq-sidebar-widget',
        'description'   => __('FAQ - Sidebar widget area', 'kyma'),
        'before_widget' => '<div class="widget_block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget_title">',
        'after_title'   => '</h6>',
    ));   
    register_sidebar(array(
        'name'          => __('NEWS - Sidebar Widget Area', 'kyma'),
        'id'            => 'news-sidebar-widget',
        'description'   => __('NEWS - Sidebar widget area', 'kyma'),
        'before_widget' => '<div class="widget_block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget_title">',
        'after_title'   => '</h6>',
    ));
    register_sidebar(array(
        'name'          => __('Gdoox University - Sidebar Widget Area', 'kyma'),
        'id'            => 'gdoox_university-sidebar-widget',
        'description'   => __('Gdoox University - Sidebar widget area', 'kyma'),
        'before_widget' => '<div class="widget_block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget_title">',
        'after_title'   => '</h6>',
    ));   
    register_sidebar(array(
        'name'          => __('Features - Sidebar Widget Area', 'kyma'),
        'id'            => 'feature_higlights-sidebar-widget',
        'description'   => __('Features - Sidebar widget area', 'kyma'),
        'before_widget' => '<div class="widget_block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget_title">',
        'after_title'   => '</h6>',
    ));       
    register_sidebar(array(
        'name'          => __('Value Proposition - Sidebar Widget Area', 'kyma'),
        'id'            => 'value_proposition-sidebar-widget',
        'description'   => __('Value Proposition - Sidebar widget area', 'kyma'),
        'before_widget' => '<div class="widget_block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget_title">',
        'after_title'   => '</h6>',
    ));       
}


