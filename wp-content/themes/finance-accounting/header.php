<?php
/**
 * The header for our theme 
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'finance-accounting' ) ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'finance-accounting' ); ?></a> -->
	<header id="masthead" class="site-header" role="banner">
		
		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>
		<div class="menu-pack">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<?php if ( has_nav_menu( 'top' ) ) : ?>
							<div class="navigation-top">
								<div class="wrap">
									<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
			        <div class="social-media col-md-3 col-sm-3">
			          <?php if( get_theme_mod( 'finance_accounting_facebook_url') != '') { ?>
			            <a href="<?php echo esc_url( get_theme_mod( 'finance_accounting_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
			          <?php } ?>
			          <?php if( get_theme_mod( 'finance_accounting_google_plus_url') != '') { ?>
			            <a href="<?php echo esc_url( get_theme_mod( 'finance_accounting_google_plus_url','' ) ); ?>"><i class="fab fa-google-plus-g"></i></a>
			          <?php } ?>
			          <?php if( get_theme_mod( 'finance_accounting_vk_url') != '') { ?>
			            <a href="<?php echo esc_url( get_theme_mod( 'finance_accounting_vk_url','' ) ); ?>"><i class="fab fa-vk"></i></a>
			          <?php } ?>
			          <?php if( get_theme_mod( 'finance_accounting_youtube_url') != '') { ?>
			            <a href="<?php echo esc_url( get_theme_mod( 'finance_accounting_youtube_url','' ) ); ?>"><i class="fab fa-youtube"></i></a>
			          <?php } ?>	          
			          <?php if( get_theme_mod( 'finance_accounting_linkdin_url') != '') { ?>
			            <a href="<?php echo esc_url( get_theme_mod( 'finance_accounting_linkdin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
			          <?php } ?>	          	           
		        	</div>
		        </div>
		    </div>
		</div>
	</header>

	<div class="site-content-contain">
		<div id="content">
