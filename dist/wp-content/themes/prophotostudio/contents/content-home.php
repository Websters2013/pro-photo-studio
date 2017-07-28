<?php
$id = pll_get_post(2);
$post_custom = get_post($id);

$video_mp4 = get_field('video_mp4', $id);
$video_ogg = get_field('video_ogg', $id);

$args = array(
	'posts_per_page' => -1,
	'orderby'     => 'menu_order',
	'post_type'   => 'portfolio',
	'fields'      => 'ids',
	'suppress_filters' => false
);

$posts = get_posts( $args );
$project = '';
?>
<div class="hero">
		<canvas class="hero__grain"></canvas>
    <div class="phrases">
        <h2><?= get_field('title_top', $id); ?></h2>
        <h3><?= $post_custom->post_content; ?></h3>
        <p><?= get_field('title_bottom', $id); ?>
	        <strong class="typistText"
	                data-letterInterval="60"
	                data-textInterval="3000"
	                data-texts='[<?php
	                if( have_rows('title_lists', $id) ) {
		                while( have_rows('title_lists', $id) ) {
			                the_row($id);
			                $list .= '"'.get_sub_field('list', $id).'", ';
		                }
		                echo substr($list, 0 , -2);
	                }
	                ?>]'></strong>
        </p>
    </div>

    <video autoplay="" muted="" loop="" style="background-color: black; background-image: url(<?= get_the_post_thumbnail_url($id) ?>)">
	    <?php
	    if (!empty($video_mp4)) {
	    ?>
	    <source src="<?= $video_mp4; ?>" type="video/mp4">
	    <?php }
	    if (!empty($video_ogg)) {
	    ?>
        <source src="<?= $video_ogg; ?>" type="video/ogg">
	    <?php }
	    ?>
    </video>
</div>

<div class="facts">

	<div class="title title_transparent title_light">

		<h2><span><?= get_field('facts_name', $id); ?></span></h2>

	</div>

	<div class="facts__wrap">
		<?php
		if( have_rows('facts_list', $id) ) {
			while( have_rows('facts_list', $id) ) {
				the_row($id);
				$fact_img = get_sub_field('fact_image', $id);
				?>
				<div class="facts__item">
            <span class="facts__icon">
                <?php echo file_get_contents($fact_img); ?>
            </span>
					<span class="facts__count" data-start="<?= get_sub_field('fact_start', $id); ?>"
					      data-end="<?= get_sub_field('fact_end', $id); ?>"
					      data-interval="<?= get_sub_field('fact_interval', $id); ?>"></span>
					<span class="facts__name"><?= get_sub_field('fact_name', $id); ?></span>
				</div>
			<?php }} ?>
	</div>

</div>

<div class="features">

    <h2 class="features__title"><span><?= get_field('features', $id); ?></span></h2>

</div>

<div class="clients">

	<div class="title title_transparent title_light">

		<h2><span><?= get_field('clients', $id); ?></span></h2>

	</div>

    <div class="clients__wrap">

	    <?php
	    if( have_rows('clients_list', $id) ) {
		    while( have_rows('clients_list', $id) ) {
			    the_row($id);
			    $client_img = get_sub_field('client', $id);
		?>
            <div class="clients__item">
                <img src="<?= $client_img['url']; ?>" alt="<?= $client_img['alt']; ?>" title="<?= $client_img['title']; ?>">
            </div>
	    <?php }} ?>

    </div>
</div>

<div class="title">

    <h2><span><?= get_field('projects', $id); ?></span></h2>

	<p><?= get_field('projects_description', $id); ?></p>
	
</div>

<div class="portfolio">

	<?php
        foreach($posts as $post){
            setup_postdata($post);
            $thumbnail_url = get_the_post_thumbnail_url($post);
            $title = get_the_title($post);
            $permalink = get_permalink($post);
            $link = explode('/', $permalink);
            $project .= '<div class="portfolio__item" style="background-image: url('.$thumbnail_url.')"><a href="';
            if(ICL_LANGUAGE_CODE !== 'uk') {
                $project .= '/'.ICL_LANGUAGE_CODE;
            }
            $project .= '/portfolio/'.$link[count($link)-2].'/" data-id="'.$post.'" class="menu__item"><span class="portfolio__item-info">'.
            $title.'</span></a></div>';

        }
        echo $project;
	?>

</div>