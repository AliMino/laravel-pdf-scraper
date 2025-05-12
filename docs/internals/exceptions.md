<span align="center">

<h1 id="top">Laravel PDF Scraper</h1>

**Save *(Websites)* as PDF**

<h2>Application's internals - Exceptions</h2>

</span>

### Exceptions Handling

The [application's exception handler](../../app/Exceptions/Handler.php) uses the custom [`MapToAPIException`](../../app/Exceptions/Traits/MapToAPIException.php) trait to map thrown exception to instances of the [`APIException`](#the-apiexception-class), mapped instances are easily converted into API responses.

Each exception type is mapped by a dedicated method in the handler class, such method must be marked with the [`ExceptionMapper`](../../app/Exceptions/Attributes/ExceptionMapper.php) attribute. The selection of the appropriate mapper method is based on the type of the first argument sent to the mapper method. The current request is passed to the mapper method as the second argument.

***

### The APIException Class

The [`APIException`](../../app/Exceptions/API/APIException.php) class is the base of all exceptions thrown by the application's API. It extends the builtin `Exception` class to define the `statusCode` public property and the `toJsonResponse()` public method.

<span align="center">

<hr width="70%">

[Top](#top)
&emsp; | &emsp;
[Home](../README.md)
&emsp; | &emsp;
[Index](index.md)

</span>
