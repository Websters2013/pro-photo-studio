<?php

$loadedGroup = $_GET['loadedGroup'];

if ( $loadedGroup == 0 ){

    $json_data = '{
                    "has_items": 1,
                    "items":[
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        }
                    ]
                }';

} else if ( $loadedGroup == 1 ){

    $json_data = '{
                    "has_items": 0,
                    "items":[
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        },
                        {
                            "title": "title",
                            "dummy": "pic/img-036.jpg"
                        }
                    ]
                }';

};

echo $json_data;
exit;
?>
