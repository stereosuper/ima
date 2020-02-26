<form role="search" method="get" class="searchform" id="search-sitemap" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input class="input-search-sitemap" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="Vos mots clés" />
		<button class="btn-form" name="submitted">
			<span class="txt-btn-form">Rechercher</span>
		</button>
	</div>
</form>