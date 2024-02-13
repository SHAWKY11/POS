<?php

return [
    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
        ],
        
        'admin' =>[],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
