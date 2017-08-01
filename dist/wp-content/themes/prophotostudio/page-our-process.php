<?php
/*
Template Name: Our Process
*/
 get_header();
 get_template_part('contents/content', 'submenu');
$post_id = 202;
$steps = get_field('steps', $post_id);
$offside_button = get_field('offside_button', $post_id);
$steps_string = '';
if($steps) {
    foreach ($steps as $row) {
	    $title = '';
        if($row['show_width'] === '0') {
            $title = '<h2>'.$row['title'].'</h2>';
        }
        $image = $row['image'];
        $steps_string .= ' <!-- process__item -->
            <div class="process__item">
                '.$title.'
                <!-- process__content -->
                <div class="process__content">
                    <p class="process__topic">'.$row['topic'].'</p>
                    '.$row['content'].'
                </div>
                <!-- /process__content -->

                <!-- process__img -->
                <div class="process__img">
                    <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
                </div>
                <!-- process__img -->

            </div>
            <!-- /process__item -->';
    }
}
?>

    <!-- process -->
    <article class="process">

        <!-- process__preface -->
        <div class="process__preface">

	        <?= get_post_field('post_content', $post_id); ?>

            <!-- process__video -->
            <div class="process__video">
	            <?= get_field('video', $post_id); ?>
            </div>
            <!-- /process__video -->

        </div>
        <!-- /process__preface -->

        <!-- process__wrap -->
        <div class="process__wrap">

            <?= $steps_string; ?>

        </div>
        <!-- /process__wrap -->

        <!-- process__footer -->
        <div class="process__footer">

            <?= get_field('offside_footer', $post_id); ?>

            <a href="<?= $offside_button['url']; ?>" class="btn btn_1"><?= $offside_button['title']; ?></a>

        </div>
        <!-- /process__footer -->

    </article>
    <!-- /process -->

<?php get_footer(); ?>