<?php
/**
 * Template Name: Home Custom Page
 */
?>
<?php
    // Get pages set in the customizer (if any)
    $pages = array();
    for ( $count = 1; $count <= 5; $count++ ) {
    $mod = absint( get_theme_mod( 'finance_accounting_slide_page' . $count ));
    if ( 'page-none-selected' != $mod ) {
      $pages[] = $mod;
    }
    }
    if( !empty($pages) ) :
      $args = array(
        'posts_per_page' => 5,
        'post_type' => 'page',
        'post__in' => $pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        $count = 1;
        ?>
      <div class="slider-main">
          <div id="slider" class="nivoSlider">
            <?php
              $finance_accounting_n = 0;
          while ( $query->have_posts() ) : $query->the_post();
            
            $finance_accounting_n++;
            $finance_accounting_slideno[] = $finance_accounting_n;
            $finance_accounting_slidetitle[] = get_the_title();
            $finance_accounting_slidecontent[] = get_the_excerpt();
            $finance_accounting_slidelink[] = esc_url(get_permalink());
            ?>
              <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $finance_accounting_n ); ?>" />
            <?php
          $count++;
          endwhile;
            wp_reset_postdata();?>
          </div>

        <?php
        $finance_accounting_k = 0;
          foreach( $finance_accounting_slideno as $finance_accounting_sln ){ ?>
          <div id="slidecaption<?php echo esc_attr( $finance_accounting_sln ); ?>" class="nivo-html-caption">
            <div class="slide-cap  ">
              <div class="container">
                <h2><?php echo esc_html($finance_accounting_slidetitle[$finance_accounting_k] ); ?></h2>
                <p><?php echo esc_html($finance_accounting_slidecontent[$finance_accounting_k] ); ?></p>
                <div class="read-more">
                  <a href="<?php echo esc_url($finance_accounting_slidelink[$finance_accounting_k] ); ?>"><?php esc_html_e( 'Read More','finance-accounting' ); ?></a>
                </div>              
              </div>
            </div>
          </div>
            <?php $finance_accounting_k++;
        } ?>
      </div>
        <?php else : ?>
            <div class="header-no-slider"></div>
        <?php
      endif;
    endif;
  ?>

<?php do_action( 'finance_accounting_after_slider' ); ?>

<section id="services">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
          <h2><?php echo esc_html(get_theme_mod('finance_accounting_section_title',__('OUR SERVICES','finance-accounting'))); ?></h2>
          <hr class="horizontal-line">
          <?php
            $args = array( 'name' => get_theme_mod('finance_accounting_single_post',''));
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post(); ?>
                  <h5><?php the_title(); ?></h5>
                  <p><?php the_excerpt(); ?></p>  
                  <div class ="testbutton">
                    <a href="<?php the_permalink(); ?>"> <?php echo esc_html(get_theme_mod('finance_accounting_about_name',__('SEE MORE','finance-accounting'))); ?> <i class="fas fa-arrow-right"></i></a>
                  </div>
              <?php endwhile; 
              wp_reset_postdata();?>
              <?php else : ?>
                <div class="no-postfound"></div>
              <?php
          endif; ?>
      </div>
      <div class="col-md-4">
        <?php 
          $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('finance_accounting_blogcategory_setting'),'theblog')));?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="trainerbox">
                  <div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div>
                </div>
              </div>
              <div class="col-md-8">
                <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                <p><?php the_excerpt(); ?></p>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata();
        ?>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-4">
          <?php 
            $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('finance_accounting_blogcategory_setting1'),'theblog')));?>
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="row">
                <div class="col-md-4 col-sm-4">
                  <div class="trainerbox">
                    <div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div>
                  </div>
                </div>                  
                <div class="col-md-8">
                  <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                  <p><?php the_excerpt(); ?></p>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          ?>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>