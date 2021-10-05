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
                            'page' => "/seller/car/create"
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
                            'page' => "/seller/car/model/create"
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
                            'page' => "/seller/car/year/create"
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
                            'page' => "/seller/car/capacity/create"
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
        [
            'title' => 'My information',
            'icon' => 'fas fa-user-circle',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'View',
                    'page' => "/seller/my-account"
                ],
            ]
        ],

    ]

];
