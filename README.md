<h3 align="center">Geoserver PHP</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg?style=flat-square)]()
![GitHub issues](https://img.shields.io/github/issues/Lowe-Man/geoserver-php?style=flat-square)
![GitHub pull requests](https://img.shields.io/github/issues-pr/Lowe-Man/geoserver-php?style=flat-square)
![GitHub](https://img.shields.io/github/license/Lowe-Man/geoserver-php?color=blue&style=flat-square)
![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/Lowe-Man/geoserver-php?label=release&style=flat-square)

</div>

---

<p align="center"> This is a PHP wrapper for Geoserver
    <br> 
</p>

## 📝 Table of Contents

- [About](#about)
    - [Changelog](CHANGELOG.md)
- [Getting Started](#getting_started)
- [API Usage](#api_usage)
- [Authors](#authors)

## 🧐 About <a name="about"></a>

---
This project was created to help developers easily interact with the geoserver API.

## 🏁 Getting Started <a name="getting_started"></a>

---
These instructions will get you a copy of Geoserver PHP up and running.

### Prerequisites

In order to install this package you have to install `composer` which can be done by following the steps based on your system [here](https://getcomposer.org/doc/00-intro.md).

If you have not done so already run `composer init` in the root of your project directory, do so now to start using composer. Just follow the prompts as they appear.

### Installing

To install Geoserver PHP run the command below while in your project root.

```php
composer require lowem/geoserver-php
```

Create a new PHP file and add the code below to the top of the file to automatically load in the package as well as any others you may have installed. The `use` statement prevents you from having to type in the full namespace of the package.

```php
require_once "vendor/autoload.php";
use Lowem\GeoserverPHP\Workspaces;
use Lowem\GeoserverPHP\CoverageStores;
```

## 🎈 API Usage <a name="api_usage"></a>

### Workspace `new Workspaces(baseURL)`

- `getAll()` - Returns a JSON object of all the workspaces available along with each one's attributes.
    - **Example:**
      ```php
      $workspace = new Workspaces("http://192.168.160.137:8080");
      $workspace->setBasicAuth("admin", "geoserver");
      $result = "";
      try {
        $result = $workspace->getAll();
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      print_r($result);
      ```
- `create(workspaceName)` - Creates a new workspace.
    - **Example:**
      ```php
      $workspace = new Workspaces("http://192.168.160.137:8080");
      $workspace->setBasicAuth("admin", "geoserver");
      try {
        $workspace->create("Test1");
      } catch (HTTPRequestException $e) {
      echo $e->getCustomMessage();
      }
      ```
- `get(workspaceName)` - Returns the attributes of a specific workspace.
    - **Example:**
      ```php
      $workspace = new Workspaces("http://192.168.160.137:8080");
      $workspace->setBasicAuth("admin", "geoserver");
      $result = "";
      try {
        $result = $workspace->get("Test1");
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      print_r($result);
      ```
- `update(currentWorkspaceName, newWorkspaceName)` - Rename a specific workspace.
    - **Example:**
      ```php
      $workspace = new Workspaces("http://192.168.160.137:8080");
      $workspace->setBasicAuth("admin", "geoserver");
      try {
        $workspace->update("Test1", "Test12");
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      ```
- `delete(workspaceName, recurse)` - Deletes a specific workspace and has a boolean option (`recurse`) to delete all the stores within.
    - **Example:**
      ```php
      $workspace = new Workspaces("http://192.168.160.137:8080");
      $workspace->setBasicAuth("admin", "geoserver");
      try {
        $workspace->delete("Test12", TRUE);
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      ```
### CoverageStores `new CoverageStores(baseUrl)`
- `getAll(workspaceName)` - Returns a JSON object of all stores available in a specific workspace.
    - **Example:**
      ```php
      $coverageStore = new CoverageStores("http://192.168.160.137:8080");
      $coverageStore->setBasicAuth("admin", "geoserver");
      $result = "";
      try {
        $result = $coverageStore->getAll("World_Claim");
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      print_r($result);
      ```
- `create(data)` - Create a new coverage store by inputting a key value pair array of attributes
    - **Example:**
      ```php
      $coverageStore = new CoverageStores("http://192.168.160.137:8080");
      $coverageStore->setBasicAuth("admin", "geoserver");
      try {
        $coverageStore->create([
          "name" => "TestCoverStore2",
          "description" => "This is a test store",
          "workspace" => "Test1",
          "enabled" => "true",
          "type" => "GeoTIFF"
        ]);
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      ```
- `get(workspaceName, store)` - Get a coverage store while outputting the result using JSON.
    - **Example:**
      ```php
      $coverageStore = new CoverageStores("http://192.168.160.137:8080");
      $coverageStore->setBasicAuth("admin", "geoserver");
      $result = "";
      try {
        $result = $coverageStore->get("Test1", "TestCoverStore2");
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      print_r($result);
      ```
- `update(workspaceName, store, data)` - Update a coverage store by inputting a key value pair array of attributes.

    **Note:** You only need to supply the fields that you would like to update.
    - **Example:**
      ```php
      $coverageStore = new CoverageStores("http://192.168.160.137:8080");
      $coverageStore->setBasicAuth("admin", "geoserver");
      try {
        $coverageStore->update("Test1", "TestCoverStore2", [
          "name" => "TestCover"
        ]);
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      ```
- `geoTiffUpload(workspaceName, store, absFilePath)` - Add geoTiff file to a store.
    - **Example:**
      ```php
      $coverageStore = new CoverageStores("http://192.168.160.137:8080");
      $coverageStore->setBasicAuth("admin", "geoserver");
      try {
        $coverageStore->geoTiffUpload("Test1", "test10", "C:\Users\LoweM\Downloads\wc2.1_2.5m_prec_2010-2018\wc2.1_2.5m_prec_2010-03.tif");
      } catch (HTTPRequestException $e) {
        echo $e->getCustomMessage();
      }
      ```
## ✍️ Authors <a name="authors"></a>

- [@Lowe-Man](https://github.com/Lowe-Man) - Idea & Initial work

See also the list of [contributors](https://github.com/Lowe-Man/geoserver-php/contributors) who participated in this project.
