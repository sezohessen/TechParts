<?php
// Aside menu
return [

    'items' => [
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
            'title' => 'Car parts',
            'icon' => 'fas fa-tools',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add part',
                    'page' => "/seller/part/create"
                ],
                [
                    'title' => 'View parts',
                    'page' => '/seller/part'
                ],
            ]
        ],

    ]

];
