<form role="search" method="get" class="searchform" id="search-sitemap" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset>
		<input class="input-search-sitemap" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="Vos mots clés" />
		<button class="btn-form" name="submitted">
			<span class="container-fond-btn-form">
				<span class="fond-btn-form"></span>
			</span>
			<span class="txt-btn-form"><span class="icon-arrow-right"></span> Rechercher</span>
		</button>
	</fieldset>
</form>