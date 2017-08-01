<?php
/*
Template Name: Video
*/
get_header();
$post_id = 228;
$video_string = '';
$video = get_field('video', $post_id);
if($video) {
    $counter = 0;
    foreach ($video as $row) {
        $class = 'item';
        if($counter < 1) {
	        $class = 'top';
        }
       $video_string .= '<!-- video__top -->
            <div class="video__'.$class.'">
                '.$row['url'].'
            </div>
            <!-- /video__top -->';
       $counter++;
    }
}
?>

    <!-- video -->
    <div class="video">

        <a href="<?= get_permalink(8); ?>" class="video__back"><?= get_field('button_title_back', 8); ?></a>

        <!-- video__preface -->
        <div class="video__preface">
	        <?= get_post_field('post_content', $post_id); ?>
        </div>
        <!-- /video__preface -->

        <!-- video__wrap -->
        <div class="video__wrap">

            <?= $video_string; ?>

        </div>
        <!-- /video__wrap -->


    </div>
    <!-- /video -->

<?php get_footer(); ?>