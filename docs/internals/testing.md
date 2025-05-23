<span align="center">

<h1 id="top">Laravel PDF Scraper</h1>

**Save *(Websites)* as PDF**

<h2>Application's Internals - Tesing</h2>

</span>

### The *testing* Environment

Analouge to the *docker-compose.yml* and *.env*, the *docker-compose.test.yml* and *.env.testing* files are used to run the tests in a separate environment. They use the same image as the *docker-compose.yml* file, but it uses a different database and a different set of environment variables.

Prepare the testing database by running the following command:

```shell
vendor/bin/sail php artisan jwt:secret --env=testing
```

There is no need to run the migrations and seeders while testing, as they are already executed before every test.

### Running the Tests

To run the tests, you can use the following command:

```shell
vendor/bin/sail test
```

<span align="center">

<hr width="70%">

[Top](#top)
&emsp; | &emsp;
[Home](../README.md)

</span>
