<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

/*
|--------------------------------------------------------------------------
| FAQS (Frequently Asked Questions Section)
|--------------------------------------------------------------------------
*/
        [
            'title' => 'FAQS',
            'icon' => 'media/svg/icons/Communication/Group-chat.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add FAQ',
                    'page' => "/dashboard/faqs/create"
                ],
                [
                    'title' => 'View FAQS',
                    'page' => '/dashboard/faqs'
                ],

            ]
        ],
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
                            'title' => 'Add Insurance',
                            'page' => "/dashboard/insurance/create"
                        ],
                        [
                            'title' => 'View Insurance',
                            'page' => '/dashboard/insurance'
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
                            'page' => "/dashboard/insurance-offer/create"
                        ],
                        [
                            'title' => 'View offers',
                            'page' => '/dashboard/insurance-offer'
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
                            'page' => "/dashboard/offer-plan/create"
                        ],
                        [
                            'title' => 'View Plans',
                            'page' => '/dashboard/offer-plan'
                        ],

                    ]
                ],

            ]
        ],
        [
            'title' => 'Location',
            'icon' => 'fas fa-map-marked-alt',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Countries',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Country',
                            'page' => "/dashboard/country/create"
                        ],
                        [
                            'title' => 'View Countries',
                            'page' => '/dashboard/country'
                        ],

                    ]
                ],
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
            'title' => 'Badges',
            'icon' => 'media/svg/icons/General/Star.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add Badge',
                    'page' => "/dashboard/badge/create"
                ],
                [
                    'title' => 'View Badges',
                    'page' => '/dashboard/badge'
                ],

            ]
        ],
        [
            'title' => 'Features',
            'icon' => 'fas fa-feather',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add Feature',
                    'page' => "/dashboard/feature/create"
                ],
                [
                    'title' => 'View Features',
                    'page' => '/dashboard/feature'
                ],

            ]
        ],
        [
            'title' => 'News',
            'icon' => 'far fa-newspaper',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add news',
                    'page' => "/dashboard/news/create"
                ],
                [
                    'title' => 'View news',
                    'page' => '/dashboard/news'
                ],

            ]
        ],
        [
            'title' => 'Categories',
            'icon' => 'fas fa-pager',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add category',
                    'page' => "/dashboard/category/create"
                ],
                [
                    'title' => 'View news',
                    'page' => '/dashboard/category'
                ],

            ]
        ],
        [
            'title' => 'Terms',
            'icon' => 'far fa-address-book',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'View Terms',
                    'page' => "/dashboard/terms"
                ],
            ]
        ],
        [
            'title' => 'General',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Fixed Content',
                    'page' => 'layout/general/fixed-content',

                ],
                [
                    'title' => 'Minimized Aside',
                    'page' => 'layout/general/minimized-aside'
                ],

            ]
        ],
        [
            'title' => 'Settings',
            'icon' => 'media/svg/icons/General/settings-2.svg',
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
