<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],




        // Layout
        [
            'section' => 'Layout',
        ],

        [
            'title' => 'General',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Fixed Content',
                    'page' => 'layout/general/fixed-content'
                ],
                [
                    'title' => 'Minimized Aside',
                    'page' => 'layout/general/minimized-aside'
                ],

            ]
        ],

    ]

];
