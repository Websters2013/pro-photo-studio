<?php
/*
Template Name: Amazon
*/
 get_header();
$post_id = 292;
$templates = get_field('templates', $post_id);
$templates_string = '';
if($templates) {
    foreach ($templates as $row) {
        $image = $row['image'];
	    $address = '';
        if($row['show_template'] === '0') {
            $trigger = $row['trigger'];
            if($trigger) {
                foreach ($trigger as $rows) {
                    $images = $rows['image'];
	                $trigger_string .= '<div class="amazon__advantages-item">
        
                        <div class="amazon__advantages-icon">
                            <img src="'.$images['url'].'" alt="'.$images['alt'].'" title="'.$images['title'].'"/>
                        </div>
        
                        <h3>'.$rows['title'].'</h3>
        
                        <p>'.$rows['content'].'</p>
        
                    </div>';
                }
            } else {
                continue;
            }
	        $templates_string .= '<!-- amazon__advantages -->
                <div class="amazon__advantages">
                    '.$trigger_string.'
                </div>
                <!-- /amazon__advantages -->';
            continue;
        } elseif($row['show_template'] === '1') {
	        $templates_string .= '<!-- amazon__item -->
        <div class="amazon__item">
            
            <!-- amazon__item-content -->
            <div class="amazon__item-content">

                <h2>'.$row['title'].'</h2>
                
                '.$row['content'].'
                
                <div class="amazon__item-address">
                    '.$row['address'].'
                </div>

            </div>
            <!-- /amazon__item-content -->

            <!-- amazon__item-content -->
            <div class="amazon__item-img">
                <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
            </div>

        </div>
        <!-- /amazon__item -->';

        } elseif ($row['show_template'] === '2') {

	        $sub_image = $row['ofsside_content_image'];
            $paragrafs = $row['paragrafs'];
            if($paragrafs) {
                foreach ($paragrafs as $rows) {
	                $content .= '<dt>'.$rows['title'].'</dt>
                    <dd>'.$rows['content'].'</dd>';
                }

                $templates_string .= '<!-- amazon__item -->
                <div class="amazon__item">
    
                    <h2>'.$row['title'].'</h2>
        
                    <!-- amazon__item-content -->
                    <div class="amazon__item-content">
        
                        <dl>'.$content.'</dl>
                        
                        <img src="'.$sub_image['url'].'" alt="'.$sub_image['alt'].'" title="'.$sub_image['title'].'"/>
                        
                        <a href="'.get_permalink(16).'" class="btn">'.$row['title_button'].'</a>
                        
                    </div>
                    <!-- /amazon__item-content -->
        
                    <!-- amazon__item-content -->
                    <div class="amazon__item-img">
                        <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
                    </div>
    
                </div>
                <!-- /amazon__item -->';
            }
        }elseif ($row['show_template'] === '3') {
	        $paragrafs = $row['paragrafs'];
	        $paragrafs_string = '';
	        if($paragrafs) {
	            foreach ($paragrafs as $row2) {
			            $paragrafs_string .= '<dt>'.$row2['title'].'</dt>
                    <dd>'.$row2['content'].'</dd>';
                }
            }
	        $templates_string .= '<!-- amazon__item -->
            <div class="amazon__item">

                <h2>'.$row['title'].'</h2>

                <!-- amazon__item-content -->
                <div class="amazon__item-content">

                     '.$row['content'].'

                    <dl>
                        '.$paragrafs_string.'
                    </dl>

                    <p><span>'.$row['title_color'].'</span></p>

                </div>
                <!-- /amazon__item-content -->

                <!-- amazon__item-content -->
                <div class="amazon__item-img">
                    <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
                </div>

            </div>
            <!-- /amazon__item -->';

        }elseif ($row['show_template'] === '4') {
	        $templates_string .= '<!-- amazon__item -->
            <div class="amazon__item">

                <h2>'.$row['title'].'</h2>

                <!-- amazon__item-content -->
                <div class="amazon__item-content amazon__item-content_1">

                     '.$row['content'].'
                     
                    <a href="'.get_permalink(16).'" class="btn">'.$row['title_button'].'</a>

                </div>
                <!-- /amazon__item-content -->

                <!-- amazon__item-content -->
                <div class="amazon__item-img">
                    <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
                </div>

            </div>
            <!-- /amazon__item -->';
        }


    }
}
?>

    <!-- promo -->
    <article class="amazon article">

        <!-- amazon__preface -->
        <div class="amazon__preface">

            <!-- amazon__title -->
            <div class="amazon__title">

	            <?= get_post_field('post_content', $post_id); ?>

            </div>
            <!-- /amazon__title -->

            <p><?= get_field('subtitle', $post_id); ?></p>

        </div>
        <!-- /amazon__preface -->

        <?= $templates_string; ?>

        <div class="amazon__footer">

            <?= get_field('footer', $post_id); ?>

        </div>

    </article>
    <!-- /promo -->

<?php get_footer(); ?>