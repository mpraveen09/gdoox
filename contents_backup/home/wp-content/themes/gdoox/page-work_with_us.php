<?php
//Template Name: Work With Us Page
get_header(); ?>
    <!-- Page Title -->
<?php get_template_part('breadcrumbs'); ?>

	<?php
	$label_feature="Main Features";
	$label_readmore="Read More";
	$label_news="News and Updates";
	$label_market="View Marketplace";
	$marketplace_link="#";
	$marketplace_text="";
	$feature_cols=1;
	?>

  <section class="content_section features-main">
      <div class="content">

        <div class="internal_post_con clearfix">
                <!-- All Content -->
                <div class="content_block col-md-12">
                    <div class="hm_blog_full_list hm_blog_list clearfix">
                        <!-- Post Container -->
                        <?php
                        if (have_posts()):
                        while (have_posts()):
                        the_post(); ?>
                        <div id="<?php get_the_id(); ?>" <?php post_class('clearfix'); ?> >
              <div class="blog_grid_con">
                                <?php the_content(); ?>
                            </div>

                      </div>
          <?php
                    endwhile;
                    endif;
                    ?>
                </div>
              </div>
        </div>
    </div>
			
			
			

<?php 
$args = array(
	'post_type' => 'work_with_us'
);
// the query
$the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>    
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>        
  <!--Investor forms-->        
    <div class="content">
      <div class="internal_post_con clearfix">


        <div class="content_block col-md-12">
            <?php the_content(); ?>
     
        <?php if( !empty( get('tab_1_form')) || !empty( get('tab_2_form') ) || 
                !empty( get('tab_3_form')) || !empty( get('tab_4_form')) ){ ?>            
        <div>
          <!-- Nav tabs -->

          <ul class="nav nav-tabs" role="tablist">
              <?php if( !empty( get('tab_1_form')) ){?>
                <li role="presentation" class="active">
                    <a href="#tab_1_form" role="tab" data-toggle="tab">
                    <?php if( !empty( get('tab_1_title')) ) {
                      echo get('tab_1_title');
                    }else{
                      echo 'Tab 1';
                    }?>  
                    </a>
                </li>
            <?php } ?>
              <?php if( !empty( get('tab_2_form')) ){?>
                <li role="presentation" >
                    <a href="#tab_2_form" role="tab" data-toggle="tab">
                    <?php if( !empty( get('tab_2_title')) ) {
                      echo get('tab_2_title');
                    }else{
                      echo 'Tab 2';
                    }?>  
                    </a>
                </li>
            <?php } ?>
              <?php if( !empty( get('tab_3_form')) ){?>
                <li role="presentation" >
                    <a href="#tab_3_form" role="tab" data-toggle="tab">
                    <?php if( !empty( get('tab_3_title')) ) {
                      echo get('tab_3_title');
                    }else{
                      echo 'Tab 3';
                    }?>  
                    </a>
                </li>
            <?php } ?>
              <?php if( !empty( get('tab_4_form')) ){?>
                <li role="presentation" >
                    <a href="#tab_4_form" role="tab" data-toggle="tab">
                    <?php if( !empty( get('tab_4_title')) ) {
                      echo get('tab_4_title');
                    }else{
                      echo 'Tab 4';
                    }?>  
                    </a>
                </li>
            <?php } ?>        
          </ul>
            
            
          <!-- Tab panes -->
          <div class="tab-content">
              <br/>
            <?php if( !empty( get('tab_1_form')) ){?>
              <div role="tabpanel" class="tab-pane active" id="tab_1_form">
                <?php //var_dump( get_post_meta(get('individual_investor_form')) ) ;
                  $frm_id = get('tab_1_form');
                  $frm_title = get_the_title($frm_id);
                  $shortcode = '[contact-form-7 id="' . $frm_id . '" title="' . $frm_title . '"]';
                  echo do_shortcode($shortcode);
                ?>                  
              </div>
            <?php } ?>               
            <?php if( !empty( get('tab_2_form')) ){?>
              <div role="tabpanel" class="tab-pane" id="tab_2_form">
                <?php //var_dump( get_post_meta(get('individual_investor_form')) ) ;
                  $frm_id = get('tab_2_form');
                  $frm_title = get_the_title($frm_id);
                  $shortcode = '[contact-form-7 id="' . $frm_id . '" title="' . $frm_title . '"]';
                  echo do_shortcode($shortcode);
                ?>                  
              </div>
            <?php } ?>  
            <?php if( !empty( get('tab_3_form')) ){?>
              <div role="tabpanel" class="tab-pane" id="tab_3_form">
                <?php //var_dump( get_post_meta(get('individual_investor_form')) ) ;
                  $frm_id = get('tab_3_form');
                  $frm_title = get_the_title($frm_id);
                  $shortcode = '[contact-form-7 id="' . $frm_id . '" title="' . $frm_title . '"]';
                  echo do_shortcode($shortcode);
                ?>                  
              </div>
            <?php } ?>                
            <?php if( !empty( get('tab_4_form')) ){?>
              <div role="tabpanel" class="tab-pane" id="tab_4_form">
                <?php //var_dump( get_post_meta(get('individual_investor_form')) ) ;
                  $frm_id = get('tab_4_form');
                  $frm_title = get_the_title($frm_id);
                  $shortcode = '[contact-form-7 id="' . $frm_id . '" title="' . $frm_title . '"]';
                  echo do_shortcode($shortcode);
                ?>                  
              </div>
            <?php } ?>  
              
          </div>            
            
        </div> 
        <?php } ?>              
            
            
          
        </div>


      </div>
    </div>
  <!--Investor forms-->       
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>   
<?php endif; ?>
        
    </section>
    <!-- End All Content -->
<?php get_footer(); ?>			