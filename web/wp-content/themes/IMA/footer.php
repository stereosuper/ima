<footer id="footer">
	<!--<div class="bandeau-footer"></div>-->
		<div class="container">
			<ul id="footer-elements">
				<li class="padding-top-footer">
					<nav id="nav-footer">
						<?php wp_nav_menu( array( 'theme_location' => 'menuFooter', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s"><li><a href="#" title="Plan du site" id="lien-sitemap">Plan du site</a></li>%3$s</ul>') ); ?>
					</nav>
				</li>
				<?php dynamic_sidebar( 'footer' ); ?>
			</ul>
		</div>
</footer>

<?php wp_footer(); ?>

<?php if(is_page_template('logos-miniatures.php')){ ?>
	<script>
		if($("body").hasClass("clipboard")){
			ZeroClipboard.config({ forceHandCursor: true });
			var copy_sel = $('.slider-logos').find('a');

		    // Disables other default handlers on click (avoid issues)
		    copy_sel.on('click', function(e) {
		        e.preventDefault();
		    });

		    // Apply clipboard click event
		    copy_sel.clipboard({
		        path: "<?php echo get_template_directory_uri(); ?>/flashes/jquery.clipboard.swf",
		        copy: function() {
		        	var this_sel = $(this);
		        	$(".telecharger-logo-bloc .txt-telecharger-logo-bloc", this_sel).text("Lien copié");
		        	$(".txt-telecharger-logo-bloc", this_sel).text("Lien copié");
		        	setTimeout(function(){
		        		$(".telecharger-logo-bloc .txt-telecharger-logo-bloc", this_sel).text("Copier le lien");
		        		$(".txt-telecharger-logo-bloc", this_sel).text("Copier le lien");
		        	}, 500);
		        	return $(this).attr('href');
		        }
		    });
		}
	</script>
<?php } ?>

<?php if(isset($_GET['embed-ima']) && $_GET['embed-ima']){ ?>
	<script>
		$(function(){
			function makeAllLinksExternal(){
				$('body').on('click', 'a', function(e){
					e.preventDefault();

					if($(this).attr('id') === 'lien-close-modal' || $(this).attr('id') === 'lien-close-interlocuteur-modal'){
						window.parent.postMessage('close', '*');
					}else if(!$(this).hasClass('btn-bloc')){
						window.parent.postMessage($(this).attr('href'), '*');
					}
				});
			}

			if($(window).outerWidth() > 1024 && $.cookie('cookieMenu') !== null){
				ouvertureMenu();
				setTimeout(fermetureMenu, 2000);
			}

			makeAllLinksExternal();
		});
	</script>
<?php } ?>

</body>
</html>
