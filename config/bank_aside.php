<?php
// Aside menu
return [

    'items' => [
        // Bank
        /*  [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ], */
        [
            'title' => 'Banks',
            'icon' => 'fas fa-synagogue',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Bank company',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Edit Bank',
                            'page' => "/bank/company/create"
                        ],
                    ]
                ],
                [
                    'title' => "Bank's offers",
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add offer',
                            'page' => "/bank/bank-offer/create"
                        ],
                        [
                            'title' => 'View offers',
                            'page' => '/bank/bank-offer'
                        ],

                    ]
                ],
            ]
        ],

    ]

];
