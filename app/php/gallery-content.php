<?php

$loadedGroup = $_GET['loadedGroup'];

if ( $loadedGroup == 0 ){

    $json_data = '{
                    "has_items": 1,
                    "items":[
                        {
                            "type": "all on-white",
                            "dummy": "pic/gallery__pic-1.jpg"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-2.jpg"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-3.jpg"
                        },
                        {
                            "type": "all on-white video",
                            "dummy": "pic/gallery__pic-6.jpg"
                        },
                        {
                            "type": "all custom-shots",
                            "dummy": "pic/gallery__pic-4.jpg"
                        },
                        {
                            "type": "all on-white apparel",
                            "dummy": "pic/gallery__pic-5.jpg"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-8.jpg"
                        },
                        {
                            "type": "all on-white custom-shots",
                            "dummy": "pic/gallery__pic-9.jpg"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-7.jpg"
                        }
                    ]
                }';

} else if ( $loadedGroup == 1 ){

    $json_data = '{
                    "has_items": 0,
                    "items":[
                        {
                            "type": "all on-white",
                            "dummy": "pic/gallery__pic-1.jpg"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-2.jpg"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-3.jpg"
                        },
                        {
                            "type": "all on-white video",
                            "dummy": "pic/gallery__pic-6.jpg"
                        },
                        {
                            "type": "all custom-shots",
                            "dummy": "pic/gallery__pic-4.jpg"
                        },
                        {
                            "type": "all on-white apparel",
                            "dummy": "pic/gallery__pic-5.jpg"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-8.jpg"
                        },
                        {
                            "type": "all on-white custom-shots",
                            "dummy": "pic/gallery__pic-9.jpg"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-7.jpg"
                        }
                    ]
                }';

};

echo $json_data;
exit;
?>
