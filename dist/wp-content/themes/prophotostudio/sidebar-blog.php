<?php
$socials_list = '';
$query = new WP_Query();
$args = array(
	'posts_per_page' => 6,
	'orderby'     => 'data',
	'order'       => 'DESC',
	'post_type'   => 'post',
	'post_status' => 'publish',
	'fields'      => 'ids',
);
$posts_string = '';
$posts = $query->query($args);
if(!empty($posts)) {
    foreach ($posts as $row) {
	    $posts_string .= '<!-- posts__item -->
        <div class="posts__item">

            <div class="posts__img">
                '.get_the_post_thumbnail($row, array(138, 82)).'
            </div>

            <div class="posts__content">
                <h2>'.get_the_title($row).'</h2>
                <time datetime="'.get_the_date('Y-m-d').'"><b>Published:</b>'.get_the_date('d, M, Y').'</time>
                <a href="'.get_permalink($row).'" class="btn">'.get_field('buttons', 87).'</a>
            </div>

        </div>
        <!-- /posts__item -->';
    }
}
$socials = get_field('socials_list', 18);
if(!empty($socials)) {
	foreach ( $socials as $row ) {
		if((array_search('1', $row['show']) === false) || empty($row['image'])) {
			continue;
		}
		$socials_list .= '<!-- social__item --><a class="followers__icons-item" href="'.$row['url'].'" target="_blank">'.file_get_contents($row['image']).'</a><!-- /social__item -->';
	}
}
?>
<div class="site__aside-top">

    <!-- join -->
    <div class="join">

        <?= get_field('join_title', 87); ?>

        <form>
            <input type="text" placeholder="Subject"/>
            <button><span>JOIN</span></button>
        </form>

    </div>
    <!-- /join -->

    <!-- followers -->
    <div class="followers">
        <p>Follow US</p>

        <div class="followers__icons">

	        <?= $socials_list; ?>

        </div>

    </div>
    <!-- /followers -->

    <!-- posts -->
    <div class="posts">

        <div class="posts__title">Recent Posts</div>

        <?= $posts_string; ?>

    </div>
    <!-- posts -->

</div>

<!-- followers -->
<div class="followers">
    <p>Share With Friends</p>

    <div class="followers__icons">

        <?= do_shortcode('[addtoany]'); ?>

        <script>
            $('.addtoany_list').find('img').addClass('style-svg');
        </script>

    </div>

</div>
<!-- /followers -->
