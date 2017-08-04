<?php
/*
Template Name: Headshot
*/
get_header();
$post_id = 260;

		$image = get_field('image', $post_id);
		$image_first = '<img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>';

?>

    <!-- headshot -->
    <article class="head-shot article" data-loaded-group="0">

        <!-- head-shot__preface -->
        <div class="head-shot__preface">

	        <?= get_post_field('post_content', $post_id); ?>

        </div>
        <!-- /head-shot__preface -->

        <!-- head-shot__top -->
        <div class="head-shot__top">

            <!-- head-shot__top-content -->
            <div class="head-shot__top-content">

                <?= get_field('top', $post_id); ?>

            </div>
            <!-- /head-shot__top-content -->

            <div class="head-shot__top-img">
                <?= $image_first; ?>
            </div>

        </div>
        <!-- /head-shot__top -->

        <!-- head-shot__command -->
        <div class="head-shot__command">

            <!-- head-shot__command-preface -->
            <div class="head-shot__command-preface">

	            <?= get_field('middle', $post_id); ?>

            </div>
            <!-- /head-shot__command-preface -->

            <div class="head-shot__command-cover">

                <!-- head-shot__command-wrap -->
                <div class="head-shot__command-wrap">

                </div>
                <!-- /head-shot__command-wrap -->

            </div>

            <a href="#" class="head-shot__command-more"><?= get_field('title_button_portfolio', 2); ?></a>

        </div>
        <!-- /head-shot__command -->

        <!-- head-shot__footer -->
        <div class="head-shot__footer">

	        <?= get_field('bottom', $post_id); ?>

            <a href="<?= get_permalink(16) ?>" class="btn"><?= get_field('button', $post_id) ?></a>

        </div>
        <!-- /head-shot__footer -->

    </article>
    <!-- /headshot -->

<?php get_footer(); ?>