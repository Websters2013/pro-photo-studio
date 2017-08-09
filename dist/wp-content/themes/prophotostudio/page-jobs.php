<?php
/*
Template Name: Jobs
*/
 get_header();
$post_id = 175;
$sub_title = get_field('sub_title', $post_id);
$sub_content = get_field('sub_content', $post_id);
$title_button = get_field('title_button', $post_id);

?>
    <!-- hiring -->
    <div class="hiring">

        <!-- hiring__title -->
        <div class="hiring__title">
	        <?= get_post_field('post_content', $post_id); ?>
        </div>
        <!-- /hiring__title -->

        <!-- hiring__item -->
        <div class="hiring__item">

            <h3><?= $sub_title; ?></h3>

            <div class="hiring__item-hide">

                <div class="hiring__item-content"><?= $sub_content; ?></div>

                <a href="#" class="hiring__btn"><?= $title_button; ?></a>

            </div>
            <!-- hiring__form -->
            <div class="hiring__form">
                <?= do_shortcode('[contact-form-7 id="182" title="Jobs"]'); ?>
            </div>
            <!-- /hiring__form -->

        </div>
        <!-- /hiring__item -->

        <!-- hiring__item -->
        <div class="hiring__item">

            <h3><?= $sub_title; ?></h3>

            <div class="hiring__item-hide">

                <div class="hiring__item-content"><?= $sub_content; ?></div>

                <a href="#" class="hiring__btn"><?= $title_button; ?></a>

            </div>
            <!-- hiring__form -->
            <div class="hiring__form">
			    <?= do_shortcode('[contact-form-7 id="182" title="Jobs"]'); ?>
            </div>
            <!-- /hiring__form -->

        </div>
        <!-- /hiring__item -->

    </div>
    <!-- /hiring -->
<script>
    $(document).ready(function () {
        var submit = $('input[type=submit]');
        submit.on('click', function (e) {
            var thisis = this;
            setTimeout(function () {
            var inputFile = $(thisis.parentNode.parentNode);
                if(inputFile.find('input[type=file]').hasClass('wpcf7-not-valid')) {
                    console.log(inputFile.find('.hiring__form-file'));
                    $(inputFile.find('.hiring__form-file')).css({'border': '1px solid red'});
                }
            }, 400);
        })
    });
</script>
<?php get_footer(); ?>