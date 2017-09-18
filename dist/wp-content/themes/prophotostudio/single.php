<?php
get_header();

$user = get_userdata($post->post_author);
  $tags = wp_get_post_terms($post->ID, 'post_tag', array("fields" => "names"));
  if(!empty($tags)) {
	  $tags = ', '.implode( ', ', $tags );
  } else {
      $tags = '';
  }
?>

	<!-- site__content -->
	<div class="site__content">

		<!-- site__text -->
		<div class="site__text">

			<!-- article -->
			<article class="article">

				<a href="<?= get_permalink(87); ?>" class="article__back"><?= get_field('button_back', 87); ?></a>

				<h1><?= get_the_title(); ?></h1>


				<!-- article__info -->
				<div class="article__info">
					<dl><dt>Published:</dt> <dd><?= get_the_date('d, M, Y'); ?></dd></dl>
					<dl><dt>Author:</dt> <dd><?= $user->first_name.' '.$user->last_name.$tags; ?>.</dd></dl>
				</div>
				<!-- /article__info -->

				<?= the_content($post->ID); ?>

			</article>
			<!-- /article -->

			<!-- comments -->
			<div class="comments">

				<h3 class="comments__title">Comments</h3>

				<?php comments_template(); ?>

			</div>
			<!-- /comments -->

		</div>
		<!-- /site__text -->

		<!-- site__aside -->
		<aside class="site__aside">

			<?php get_sidebar('blog'); ?>

		</aside>
		<!-- /site__aside -->

	</div>
	<!-- /site__content -->

<?php get_footer(); ?>