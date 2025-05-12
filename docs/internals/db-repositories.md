<span align="center">

<h1 id="top">Laravel PDF Scraper</h1>

**Save *(Websites)* as PDF**

<h2>Application's Internals - Database Repositories</h2>

</span>

### Introduction

This application utilizes the *repository* pattern for database access; making it easier to swap the implementation to communicate with arbitrary storage systems. The repositories are located in the `app/Repositories` directory.

The repositories' concrete types are bound to their corresponding interfaces in the `RepositoryServiceProvider` class.
The bound classes are specified by the *config/repositories.php* configuration file.

### Configuring the Application's Repositories

The [*config/repositories.php*](../../config/repositories.php) configuration file defines a set of repositories groups (we call them *drivers* for convinence), each of which binds a concrete type to an abstract repository type, the typical repositories driver would look like the following:

```php
<?php
return [

    'repositories' => [

        'eloquent' => [

            IUserRepository::class => UserRepository::class,

            // more repositories bindings...
        ]
    ]
];
```

The [*config/repositories.php*](../../config/repositories.php) configuration file - also - defines the `driver` configuration key to select from the defined drivers, as shown below:

```php
<?php
return [

    'driver' => env('DB_REPOSITORY_DRIVER', 'eloquent'),

    'repositories' => [

        'eloquent' => [

            IUserRepository::class => UserRepository::class,

            // more repositories bindings...
        ]
    ]
];
```

<span align="center">

<hr width="70%">

[Top](#top)
&emsp; | &emsp;
[Home](../README.md)

</span>
