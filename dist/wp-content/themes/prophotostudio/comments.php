<?php
global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
echo do_shortcode('[wpdevart_facebook_comment curent_url="'.$current_url.'/" order_type="social" title_text="" title_text_color="#000000" title_text_font_size="22" title_text_font_famely="monospace" title_text_position="left" width="100%" bg_color="#d4d4d4" animation_effect="random" count_of_comments="3" ]'); ?>