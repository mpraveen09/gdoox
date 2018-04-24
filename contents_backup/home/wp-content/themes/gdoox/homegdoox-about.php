<?php 

$args = array(
	'post_type' => 'about_us_homepage'
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <section class="content_section about_section bg_color3 white_section">
      <div class="welcome_banner full_colored">
        <div class="container row_spacer" style="padding-top:40px;">
          	<?php 
				$members = get_order_group('custom_button_text');
			if(!empty($members)){
			?>
			<div class="row ">
            	<div class="col-md-12  text-center">
					<?php
						   
						   foreach($members as $member){
							  // the second parameter for the get and get_image functions is the group index to be shown
							  echo '<a href="'.get('custom_buttons_url',$member).'" class="btn btn-danger" target="_blank" style="margin-bottom:10px; margin-left:10px; ">'.get('custom_button_text',$member).'</a>';
						   }
						?>					
					
              	</div>
            </div>
		<?php }?>			
			<div class="row">
            <div class="col-sm-6">
              <div class="content clearfix about-div">
                <h3 id="callout-title"><?php the_title(); ?></h3>
                <div class="intro_text"><?php the_content(); ?></div>        
              </div>
            </div>
            <div class="col-sm-6 about_img_vid">
              <?php 
				if( !empty( get('youtube_url') ) ){
					$yurl = apply_filters('the_content', '[embed]'. get('youtube_url') .'[/embed]');
					echo $yurl;						
				}else{
					if( !empty( get('image') ) ){
						echo get_image('image');
					}				
				}
 			?>   
				
				
				  <?php 
					if( !empty( get('textbox_right_column') ) ){
						echo '<div class="col-md-12">';
						echo get('textbox_right_column');				
						echo '</div>';
					}
				?>

				
				
            </div>

          </div>
        </div>
      </div>
    </section>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php else : ?>
	
<?php endif; ?>




<?php if ( !empty($invite_link) ) { ?>
    <section class="content_section about_section  white_section">
      <div class="welcome_banner ">
        <div class="container ">
          <div class="row">
            <div class="col-sm-12">
              <div class="content clearfix about-div">
                  <br/>
                  <h2 id="callout-title" class="text-center">
                      <a id="" href="<?php echo get_permalink($invite_link); ?>">
                          <?php echo get_the_title($invite_link); ?>
                    </a>
                  </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php } ?>
