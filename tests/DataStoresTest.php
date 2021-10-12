<?php

use Lowem\GeoserverPHP\DataStores;
use Lowem\EasyCurl\HTTPRequestException;
use PHPUnit\Framework\TestCase;

class DataStoresTest extends TestCase {
  private $baseURL = "http://192.168.160.137:8080/geoserver";

  public function testGetAll() {
    $dataStore = new DataStores($this->baseURL);
    $dataStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    $result = "";
    try {
      $result = $dataStore->getAll("acme");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
    print_r($result);
  }

  public function testCreate() {
    $dataStore = new DataStores($this->baseURL);
    $dataStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $dataStore->create([
        "name" => "TestDataStore",
        "description" => "This is a test store",
        "workspace" => "acme"
      ]);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testGet() {
    $dataStore = new DataStores($this->baseURL);
    $dataStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    $result = "";
    try {
      $result = $dataStore->get("acme", "TestDataStore");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
    print_r($result);
  }

  public function testUpdate() {
    $coverageStore = new DataStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $coverageStore->update("acme", "test123", [
        "name" => "test142"
      ]);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testShapeFileUpload() {
    $dataStore = new DataStores($this->baseURL);
    $dataStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $dataStore->shapeFileUpload("acme", "nyc_roads5", "/Users/LoweM/Downloads/nyc_roads.zip");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }
}
