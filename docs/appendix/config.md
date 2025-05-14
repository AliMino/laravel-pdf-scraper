<span align="center">

<h1 id="top">Laravel PDF Scraper</h1>

**Save *(Websites)* as PDF**

<h2>Appendix B: List of additional configuration file</h2>

</span>

### Introduction

This section lists all additional configuration file that aren't shipped in a new Laravel application.

### List of Additional Configuration Files

|                                                     Path |                   Description                   | Used In/By                                                                                         |
| -------------------------------------------------------: | :---------------------------------------------: | :------------------------------------------------------------------------------------------------- |
|       [config/app-admin.php](../../config/app-admin.php) | Contains admin name and credentials for seeding | [`Database\Seeders\AdminUserSeeder`](../../database/seeders/AdminUserSeeder.php#L21)               |
| [config/repositories.php](../../config/repositories.php) |         Binds concrete db repositories          | [`App\Providers\RepositoryServiceProvider`](../../app/Providers/RepositoryServiceProvider.php#L16) |
|       [config/url-scans.php](../../config/url-scans.php) |     Contains URL scan settings for the app      | [`App\Services\UrlScansService::requestUrlScan()`](../../app/Services/UrlScansService.php#L38)     |

<span align="center">

<hr width="70%">

[Top](#top)
&emsp; | &emsp;
[Home](../README.md)

</span>

