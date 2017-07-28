<?php
$args = array(
	'post_type'   => 'portfolio',
	'posts_per_page' => -1,
	'orderby'     => 'menu_order',
	'fields'      => 'ids',
	'suppress_filters' => false
);

$posts = get_posts( $args );
$project = '';

foreach($posts as $post){ setup_postdata($post);
	$thumbnail_url = get_the_post_thumbnail_url($post);
	$permalink = get_permalink($post);
	$link = explode('/', $permalink);
	$logo_image = get_field('logo_image', $post);
	$project .= '<!-- portfolio__item --><div class="portfolio__item" style="background-image: url('.$thumbnail_url.')"><a href="';
	if(ICL_LANGUAGE_CODE !== 'uk') {
		$project .= '/'.ICL_LANGUAGE_CODE;
	}
	$project .= '/portfolio/'.$link[count($link)-2].'/" data-id="'.$post.'"><!-- portfolio__item-info --><span class="portfolio__item-info"><img src="'.$logo_image['url'].'" alt="'.$logo_image['alt'].'" title="'.$logo_image['title'].'"></span><!-- /portfolio__item-info --></a></div><!-- /portfolio__item -->';
}
$wrap  = '';
foreach($posts as $post) {
	setup_postdata($post);
	$permalink = get_permalink($post);
	$link = explode('/', $permalink);
	$wrap .= '<div data-url="'.$link[count($link)-2].'" data-page="'.$post.'" class="pages__item hidden"></div>';
}
$id = icl_object_id( 2, true );
?>
<div class="pages" data-root="<?php if(ICL_LANGUAGE_CODE !== 'uk'){echo '/'.ICL_LANGUAGE_CODE;} ?>/portfolio/">

	<div data-url="" data-page="portfolio_index" class="pages__item">

		<div class="title">

			<h2><span><?= get_field('projects', $id); ?></span></h2>
			<p><?= get_field('projects_description', $id); ?></p>

		</div>
		<!-- /title -->

		<!-- portfolio -->
		<div class="portfolio">
			<?= $project; ?>
		</div>
		<!-- /portfolio -->

	</div>
	<?= $wrap; ?>
</div>
