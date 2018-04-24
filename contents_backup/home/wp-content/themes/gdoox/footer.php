<?php $kyma_theme_options = kyma_theme_options();
$col = 12 / (int)$kyma_theme_options['footer_layout']; ?>
<!-- footer -->
<footer id="footer">
    <div class="container row_spacer clearfix">
        <div class="rows_container clearfix">
            <?php if (is_active_sidebar('footer-widget')) {
                dynamic_sidebar('footer-widget');
            } else {
                $args = array(
                    'before_widget' => '<div class="footer-widget-col 	col-md-' . $col . '"><div class="footer_row">',
                    'after_widget' => '</div></div>',
                    'before_title' => '<h6 class="footer_title">',
                    'after_title' => '</h6>',
                );
                the_widget('WP_Widget_Tag_Cloud', null, $args);
                the_widget('WP_Widget_Meta', null, $args);
                the_widget('kyma_footer_recent_posts', null, $args);
                //the_widget('kyma_footer_contact_widget', null, $args);
            } ?>


            
        <div class="footer-widget-col 	col-md-3"><div class="footer_row"><h6 class="footer_title">Contact Us</h6>        <address>
        <p><i class="fa fa-map-marker"></i> Address: Via San Vittore, 16 – 27015 Landriano (PV) – Italy</p>

        <!--<p><i class="fa fa-phone"></i> <a href="tel:0664-3225569">0664-3225569</a></p>-->

        <p><i class="fa fa-envelope"></i> Email: <a href="mailto:join@gdoox.com">join@gdoox.com</a></p>

        <p><i class="fa fa-globe"></i> Web: www.gdoox.com</p>
        </address>
        </div></div>            
            
            
        </div>
    </div>
    <div class="footer_copyright">
        <div class="container clearfix">
            <div class="col-md-2">
                <span
                    class="footer_copy_text">&copy; <a href="<?php echo esc_url(home_url('/')); ?>">Gdoox.</a> <?php echo date('Y');?></span>
            </div>
            <div class="col-md-10 clearfix">
                <?php wp_nav_menu(array(
                        'theme_location' => 'secondary',
                        'container' => false,
                        'menu_class' => 'clearfix footer_menu',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    )
                ); ?>
            </div>
        </div>
    </div>
</footer>
<!-- End footer -->
<a href="#0" class="hm_go_top"></a>
</div>
<!-- End wrapper -->
<?php wp_footer(); 
if($kyma_theme_options['custom_css']!=""){
    echo '<style>'.$kyma_theme_options['custom_css'].'</style>';
}
?>
</body>
</html>