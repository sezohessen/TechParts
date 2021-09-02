<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'countries' => 'c,r,u,d',
            'faqs' => 'c,r,u,d',
            'governorates' => 'c,r,u,d',
            'insurances' => 'c,r,u,d',
            'agencies' => 'c,r,u,d',
            'banks' => 'c,r,u,d',
            'insurance_offers' => 'c,r,u,d',
            'bank_offers' => 'c,r,u,d',
            'news' => 'c,r,u,d',
            'offer_plans' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'terms' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'permission' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'seller' => [
            'insurances' => 'r,u',
            'insurance_offers' => 'c,r,u,d',
            'offer_plans' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
