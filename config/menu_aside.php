<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        /*  [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ], */
/*
|--------------------------------------------------------------------------
| FAQS (Frequently Asked Questions Section)
|--------------------------------------------------------------------------
*/
        [
            'title' => 'Location',
            'icon' => 'fas fa-map-marked-alt',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Governorates',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add governorate',
                            'page' => "/dashboard/governorate/create"
                        ],
                        [
                            'title' => 'View governorates',
                            'page' => '/dashboard/governorate'
                        ],

                    ]
                ],
                [
                    'title' => 'Cities',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add city',
                            'page' => "/dashboard/city/create"
                        ],
                        [
                            'title' => 'View cities',
                            'page' => '/dashboard/city'
                        ],

                    ]
                ],

            ]
        ],
        [
            'title' => 'Cars Settings',
            'icon' => 'fas fa-car',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Car Options',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add A car ',
                            'page' => "/dashboard/car/create"
                        ],
                        [
                            'title' => 'View Cars',
                            'page' => '/dashboard/car'
                        ],

                    ]
                ],
                [
                    'title' => 'Car Makers',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add a manufacturer',
                            'page' => "/dashboard/car/maker/create"
                        ],
                        [
                            'title' => 'View manufacturing',
                            'page' => '/dashboard/car/maker'
                        ],

                    ]

                ],
                [
                    'title' => 'Car Models',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Car Model',
                            'page' => "/dashboard/car/model/create"
                        ],
                        [
                            'title' => 'View Car Models',
                            'page' => '/dashboard/car/model'
                        ],

                    ]

                ],
                [
                    'title' => 'Years of manufacture',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => "Add Year ",
                            'page' => "/dashboard/car/year/create"
                        ],
                        [
                            'title' => 'View years',
                            'page' => '/dashboard/car/year'
                        ],

                    ]
                ],
                [
                    'title' => 'Car Capacities',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => "Add Capacity ",
                            'page' => "/dashboard/car/capacity/create"
                        ],
                        [
                            'title' => 'View Capacities',
                            'page' => '/dashboard/car/capacity'
                        ],

                    ]
                ],
            ]
        ],
        [
            'title' => 'Manage Users',
            'icon' => 'media/svg/icons/Communication/Group.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add User',
                    'page' => "/dashboard/users/create"
                ],
                [
                    'title' => 'View Users',
                    'page' => '/dashboard/users'
                ],

            ]
        ],
        [
            'title' => 'Contact',
            'icon' => 'fas fa-phone-square-alt',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    [
                        'title' => 'Contact Us',
                        'bullet' => 'dot',
                        'root' => true,
                        'submenu' => [
                            [
                                'title' => 'View Contacts',
                                'page' => "/dashboard/contact"
                            ],
                        ]
                    ],
                ],
            ]
        ],
        [
            'title' => 'Settings',
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'View Setting',
                    'page' => '/dashboard/settings',

                ]

            ]
        ],

    ]

];
