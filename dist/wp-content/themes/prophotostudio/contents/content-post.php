<?php

$thumbnail_url = get_the_post_thumbnail_url($post);
$thumbnail_alt = get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true);
$title = get_the_title($post);
$excerpt = get_the_excerpt();
$permalink = get_permalink($post);
$post_id = get_the_ID($post);
$author = get_the_author($post);
$time = get_the_time('M j, Y');
$tags = get_the_tags( $post );

?>
<style>
	.wrap_post img {
		width: 100%;
	}
	.wrap_post .title {
		font-size: 25px;
		color: #000;
		padding: 0;
		background-color: transparent;
		text-align: left;
	}
	.blog {
		font-size: 40px;
		text-align: center;
		margin-bottom: 40px;
	}
	.info span {
		font-weight: bold;
		padding: 5px 10px;
	}
</style>
<div class="wrap_post" id="post-<?= $post_id; ?>">
	<h3 class="title"><?= $title; ?></h3>
	<div class="info">
		<span><?= $author; ?></span>
		<span><?= $time; ?></span>
		<?php
			$tag_string = '';

			if ( $tags ) {
				foreach( $tags as $tag ) {
					$tag_string .= '<span>'.$tag->name.'</span>';
				}
				echo $tag_string;
			}

			$args_comments = array(
				'post_id' => $post,
				'count' => true
			);
			$comments = get_comments($args_comments);
			echo ' <span>Коментарии '.$comments.'</span>';
		?>
		<img src="<?= $thumbnail_url; ?>" alt="<?= $thumbnail_alt; ?>">
		<div class="content"><?= $excerpt; ?></div>
		<a href="<?= $permalink; ?>">Подробнее</a>
	</div>
</div>
