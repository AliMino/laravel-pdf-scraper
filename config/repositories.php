<?php

namespace App\Repositories;

/**
 * Configuration for Database Repositories.
 */

return [

    /**
     * This option selects which of the available repository drivers should be used.
     * The default is eloquent, which uses Eloquent ORM to manage the repositories.
     * You can also use other drivers like "database" or "mongodb" if you have
     * implemented them.
     */

    'driver' => env('DB_REPOSITORY_DRIVER', 'eloquent'),

    /**
     * The repositories configuration.
     * This is where you define the bindings for your repositories.
     * The keys are the interfaces and the values are the concrete classes.
     */
    'repositories' => [

        'eloquent' => [

            // Define repositories bindings as: interface => concrete
            
            User\IUsersRepository::class         => User\EloquentUsersRepository::class,
            UserRole\IUserRolesRepository::class => UserRole\EloquentUserRolesRepository::class,
        ]
    ]
];