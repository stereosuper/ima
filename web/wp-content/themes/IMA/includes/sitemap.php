<div id="wrapper-sitemap-modal">
	<div id="wrapper-relative-sitemap-modal">
		<div id="overlay"></div>
		<nav id="sitemap-modal">
			<div class="container-fond-modal">
				<div class="fond-modal"><div class="cercle-sitemap"></div></div>
			</div>
			<div id="content-sitemap">
				<?php get_search_form(); ?>
				<ul id="menu-sitemap">
					<?php

					$menu_name = 'primaryPlan';
					$locations = get_nav_menu_locations();
					$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
					$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
					$nbitems = count($menuitems) - 1;

					$count = 0;
					$countParent = 0;
					$submenu = false;

					foreach( $menuitems as $item ):

					    $id = get_post_meta( $item->ID, '_menu_item_object_id', true );
					    $title = $item->title;
					    $link = $item->url;

					    // item does not have a parent so menu_item_parent equals 0 (false)
					    if ( !$item->menu_item_parent ):
					        $parent_id = $item->ID;
					    	// $countParent ++;
						    // if($countParent == 1) $idlien = 'sitemap-service-client';
						    // if($countParent == 2) $idlien = 'sitemap-reflex';
						    // if($countParent == 3) $idlien = 'sitemap-accompagnement';
						    // if($countParent == 4) $idlien = 'sitemap-pole-technique';
						    // if($countParent == 5) $idlien = 'sitemap-conseil';
						    // if($countParent == 6) break;
					    	?>

					    	<li>
                                <a href="<?php echo $link; ?>" class="circle-sitemap">
                                    <span class="circle-responsive"><span class="icon-arrow-right"></span></span>
                                    <span class="txt-circle-sitemap">
					                	<?php echo $title; ?>
					                </span>
					            </a>
                        <?php 
                        endif;


						if ( $item->menu_item_parent ): 

						    if ( !$submenu && $parent_id == $item->menu_item_parent ) : $submenu = true; ?>
						        <ul class="liste-liens-sitemap">
							<?php endif; ?>


							<?php if($parent_id == $item->menu_item_parent) : ?>
								<li>
								    <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
								    <?php $subSubmenu = wp_list_pages("title_li=&echo=0&child_of=".get_post_meta($item->ID, '_menu_item_object_id', true )); ?>
								    <?php if($subSubmenu != '') : ?>
									    <ul>
									    	<?php echo $subSubmenu; ?>
									    </ul>
									<?php endif; ?>
							<?php endif; ?>	
								
							<?php if( $count < $nbitems) {
								if( $count < $nbitems && $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
									</ul>
									<?php $submenu = false; 
								endif; 
							}else{ ?>
								</ul>
								<?php $submenu = false; 
							} ?>

						<?php endif; ?>

						
						<?php if($count < $nbitems) {
							if( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
						    	</li>                           
						    	<?php $submenu = false; 
							endif; 
						}else{ ?>
							</li>                           
							<?php $submenu = false; 
						} ?>

					<?php $count++;  endforeach; ?>

				</ul><div class="autres-menus-sitemap">
					<?php wp_nav_menu( array( 'theme_location' => 'secondaryPlan', 'container' => false, 'items_wrap' => '<ul id="autre-menu-big-sitemap">%3$s</ul>') ); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'smallPlan', 'container' => false, 'items_wrap' => '<ul id="autre-menu-small-sitemap">%3$s</ul>') ); ?>
				</div>
			</div>
			<div class="titre-modal">
				<div class="container-fond-titre-modal">
					<div class="fond-titre-modal"></div>
				</div>
				<div class="txt-titre-modal"><span class="titre-modal-large">Plan du site</span> <span class="titre-modal-small">Menu</span></div>
			</div>
			<div class="close-modal">
				<div class="container-fond-close-modal">
					<div class="fond-close-modal"></div>
				</div>
				<a href="#" id="lien-close-modal"><span class="icon-close"></span></a>
			</div>
		</nav>
	</div>
</div>