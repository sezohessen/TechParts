<?php
// Aside menu
return [

    'items' => [
        // Agency
        /*  [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ], */
        [
            'title' => 'Agences',
            'icon' => 'fas fa-landmark',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Agency companies',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Edit agency',
                            'page' => "/agency/company/create"
                        ],
                    ]
                ],

            ]
        ],
        [
            'title' => 'Agency Cars',
            'icon' => 'fas fa-car',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Cars Settings',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add car',
                            'page' => "/agency/car/create"
                        ],
                        [
                            'title' => 'View cars',
                            'page' => '/agency/car'
                        ],

                    ]
                ],

            ]
        ],



    ]

];
