<?php
/**
 * Displays header site branding
 */

?>
<div class="site-branding">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<?php the_custom_logo(); ?>

				<div class="site-branding-text">
					<?php if ( is_front_page() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php
					$description = get_bloginfo( 'description', 'display' );

					if ( $description || is_customize_preview() ) :
					?>
						<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-8">
	        	<div class="row">
					<div class=" col-md-4">
						<div class="row top-data">
							<?php if( get_theme_mod( 'finance_accounting_time','' ) != '') { ?>
			                <div class="col-md-2">
			                  	<i class="fas fa-clock"></i>
			                </div>
			                <div class="col-md-10">
			                  <p class="heavy"><?php echo esc_html( get_theme_mod( 'finance_accounting_time',__('Working Time 9:00-17:00','finance-accounting') )); ?></p>
			                  <p><?php echo esc_html( get_theme_mod('finance_accounting_time1',__('Mon-Fri 8:00am to 2:00pm','finance-accounting') )); ?></p>
			                </div>
			                <?php } ?>
			             </div>
				    </div>
				    <div class=" col-md-4 col-xs-12 col-sm-4">
				      	<div class="row top-data">
				      		<?php if( get_theme_mod( 'finance_accounting_mail','' ) != '') { ?>
			                <div class="col-md-2">
			                  <i class="fas fa-envelope"></i>
			                </div>
			                <div class="col-md-10">
			                  <p class="heavy"><?php echo esc_html( get_theme_mod( 'finance_accounting_mail','' ) ); ?></p>
			                  <p><?php echo esc_html( get_theme_mod('finance_accounting_email',__('example@123.com','finance-accounting') )); ?></p>
			                </div>
			                <?php } ?>
		              	</div>
				    </div>
				    <div class=" col-md-4 col-xs-12 col-sm-5">
				      	<div class="row top-data">
				      		<?php if( get_theme_mod( 'finance_accounting_call','' ) != '') { ?>
			                <div class="col-md-2">
			                  <i class="fas fa-mobile-alt"></i>
			                </div>
			                <div class="col-md-10">
			                  <p class="heavy"><?php echo esc_html( get_theme_mod('finance_accounting_call','') ); ?></p>
			                  <p><?php echo esc_html( get_theme_mod('finance_accounting_call1',__('+123 4567 8900','finance-accounting') )); ?></p>
			                </div>
			                <?php } ?>
		              	</div>
				    </div>
				</div>
			</div>
		</div>		
	</div>
</div>
