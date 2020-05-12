<header id="header">
	<nav class='container nav c-menu__nav'>
		<a class='logo c-menu__logo' href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" id="circle-imatech" rel="home"></a>
		<?php echo wp_nav_menu(array('theme_location' => 'primaryPlan', 'menu_id' => 'header-menu')); ?>
		<button id='link-search' class='link-search c-menu__search-button'></button>
		<!--<div id="label-menu">Nos métiers</div>
		<div id="container-menu-wrapper">
			<div id="menu-wrapper">
				<div id="circle-dashed-container">
					<svg id="circle-dashed-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" viewBox="0 0 85 85">
						<circle class="cls-2" cx="42" cy="42" r="42"/>
					</svg>
				</div>
				
				<ul>
					<?php
					/*$menu_name = 'primary';
					$locations = get_nav_menu_locations();
					$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
					$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
					$count = 0;

					foreach( $menuitems as $item ):
						$count ++;
						if($count == 1) $classe = 'circle-service-client';
						if($count == 2) $classe = 'circle-pole-technique';
						if($count == 3) $classe = 'circle-reflex';
						if($count == 4) $classe = 'circle-accompagnement';
						if($count == 5) break;
						
						$id = get_post_meta( $item->ID, '_menu_item_object_id', true );
					    $page = get_page( $id );
					    $link = get_page_link( $id );*/
					?>

					    <li class="<?php //echo $classe; ?>">
					        <a href="<?php //echo $link; ?>">
					            <span class="txt-circle">
					                <?php //echo $page->post_title; ?>
					            </span>
					        </a>
					    </li>

					<?php //endforeach; ?>
				</ul>

				<a href="<?php //echo esc_url( home_url( '/' ) ); ?>" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" id="circle-imatech" rel="home"></a>
			</div>
		</div>	-->
	</nav>						
</header><!-- #masthead .site-header -->