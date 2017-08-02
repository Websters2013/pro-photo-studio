<?php
/*
Template Name: Headshot
*/
get_header();
$post_id = 260;
$button =  get_field('button', $post_id);
$headshots =  get_field('headshots', $post_id);
$headshots_string = '';
if($headshots) {
    $counter = 0;
    foreach ($headshots as $row) {
	    $image = $row['image'];
        if($counter < 1) {
           $image_first = '<img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>';
        } else {
	        $headshots_string .= '<div class="head-shot__command-item">
                    <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
                </div>';
        }
        $counter++;
    }
}
?>

    <!-- headshot -->
    <article class="head-shot article">

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

            <!-- head-shot__command-wrap -->
            <div class="head-shot__command-wrap">

                <?= $headshots_string; ?>

            </div>
            <!-- /head-shot__command-wrap -->

            <a href="#" class="head-shot__command-more"><?= get_field('title_button_portfolio', 2); ?></a>

        </div>
        <!-- /head-shot__command -->

        <!-- head-shot__footer -->
        <div class="head-shot__footer">

	        <?= get_field('bottom', $post_id); ?>

            <a href="<?= $button['url']; ?>" class="btn"><?= $button['title']; ?></a>

        </div>
        <!-- /head-shot__footer -->

    </article>
    <!-- /headshot -->

<?php get_footer(); ?>