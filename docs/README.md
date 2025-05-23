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
vendor/bin/sail php artisan db:seed

vendor/bin/sail php artisan jwt:secret
```

In addition to running the artisan server, the custom [supervisord.conf](../docker/supervisord.conf) file also defines:

- A *supervisor* process that runs the laravel's *queue*. This is necessary to process the jobs that are queued when a user requests to save a website as a PDF.
- A *supervisor* process that runs the laravel's *scheduler*. This is necessary to run the scheduled tasks (i.e., email-sending cronjobs)

***

## API Documentation

For the API documentation presented by [Swagger](https://swagger.io/), please run the project and visit the following URL: [http://localhost/docs](http://localhost/docs).

For postman collection, please import the file [docs/postman_collection.json](postman_collection.json) into your postman application.

***

## [Application's Internals](internals/index.md)

- [Database repositories](internals/db-repositories.md).
- [Exceptions](internals/exceptions.md)
- [Testing](internals/testing.md).

***

## Appendix

- [A: List of the used libraries](appendix/libraries.md).
- [B: List of additional environment variables](appendix/env.md)

<span align="center">

<hr width="70%">

[Top](#top)

</span>
