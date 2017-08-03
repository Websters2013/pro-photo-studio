<?php

$loadedGroup = $_GET['loadedGroup'];

if ( $loadedGroup == 0 ){

    $json_data = '{
                    "has_items": 1,
                    "items":[
                        {
                            "type": "all on-white",
                            "dummy": "pic/gallery__pic-1.jpg",
                            "dummy__big": "pic/gallery__pic-1.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-2.jpg",
                            "dummy__big": "pic/gallery__pic-2.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-3.jpg",
                            "dummy__big": "pic/gallery__pic-3.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all on-white video",
                            "dummy": "pic/gallery__pic-6.jpg",
                            "dummy__big": "pic/gallery__pic-6.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all custom-shots",
                            "dummy": "pic/gallery__pic-4.jpg",
                            "dummy__big": "pic/gallery__pic-4.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all on-white apparel",
                            "dummy": "pic/gallery__pic-5.jpg",
                            "dummy__big": "pic/gallery__pic-5.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-8.jpg",
                            "dummy__big": "pic/gallery__pic-8.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all on-white custom-shots",
                            "dummy": "pic/gallery__pic-9.jpg",
                            "dummy__big": "pic/gallery__pic-9.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-7.jpg",
                            "dummy__big": "pic/gallery__pic-7.jpg",
                            "title": "img",
                            "video": "0"
                        }
                    ]
                }';

} else if ( $loadedGroup == 1 ){

    $json_data = '{
                    "has_items": 0,
                    "items":[
                        {
                            "type": "all on-white",
                            "dummy": "pic/gallery__pic-1.jpg",
                            "dummy__big": "pic/gallery__pic-1.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-2.jpg",
                            "dummy__big": "pic/gallery__pic-2.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-3.jpg",
                            "dummy__big": "pic/gallery__pic-3.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all on-white video",
                            "dummy": "pic/gallery__pic-6.jpg",
                            "dummy__big": "pic/gallery__pic-6.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all custom-shots",
                            "dummy": "pic/gallery__pic-4.jpg",
                            "dummy__big": "pic/gallery__pic-4.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all on-white apparel",
                            "dummy": "pic/gallery__pic-5.jpg",
                            "dummy__big": "pic/gallery__pic-5.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all apparel",
                            "dummy": "pic/gallery__pic-8.jpg",
                            "dummy__big": "pic/gallery__pic-8.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all on-white custom-shots",
                            "dummy": "pic/gallery__pic-9.jpg",
                            "dummy__big": "pic/gallery__pic-9.jpg",
                            "title": "img",
                            "video": "0"
                        },
                        {
                            "type": "all jewelry",
                            "dummy": "pic/gallery__pic-7.jpg",
                            "dummy__big": "pic/gallery__pic-7.jpg",
                            "title": "img",
                            "video": "0"
                        }
                    ]
                }';

};

echo $json_data;
exit;
?>
