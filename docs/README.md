<span align="center">

<h1 id="top">Laravel PDF Scraper</h1>

**Save *(Websites)* as PDF**

</span>

## Run the Project

This project is build with *sail*; run it with `vendor/bin/sail up` from the project's root directory.
If you prefer to use `docker compose` instead of `vendor/bin/sail`, you will need to alter the permissions of the *storage/framework/sessions* directory to get things running.

### The First Run

When running the project for the first time, you will need to run the following commands to install the application's dependencies and setup your database:

```shell
composer update

vendor/bin/sail php artisan migrate
```

***

## [Application's Internals](internals/index.md)

- [Database repositories](internals/db-repositories.md).
- [Testing](internals/testing.md).

***

## Appendix

- [A: List of the used libraries](appendix/libraries.md).
- [B: List of additional environment variables](appendix/env.md)

## See Also

- [Application's internals](internals/index.md).

<span align="center">

<hr width="70%">

[Top](#top)

</span>
