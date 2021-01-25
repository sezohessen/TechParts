<?php
// Aside menu
return [

    'items' => [
        // Insurance
        /*  [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ], */


        [
            'title' => 'Insurances',
            'icon' => 'media/svg/icons/General/Shield-check.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Insurance companies',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Edit Insurance',
                            'page' => "insurance/company/create"
                        ],

                    ]
                ],
                [
                    'title' => 'Insurance offers',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add offer',
                            'page' => "/insurance/insurance-offer/create"
                        ],
                        [
                            'title' => 'View offers',
                            'page' => '/insurance/insurance-offer'
                        ],

                    ]
                ],
                [
                    'title' => 'Offers plan',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Plan',
                            'page' => "/insurance/offer-plan/create"
                        ],
                        [
                            'title' => 'View Plans',
                            'page' => '/insurance/offer-plan'
                        ],

                    ]
                ],

            ]
        ],

    ]

];
