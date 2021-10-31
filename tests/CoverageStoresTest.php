<?php

use Lowem\EasyCurl\HTTPRequestException;
use Lowem\GeoserverPHP\CoverageStores;
use PHPUnit\Framework\TestCase;

class CoverageStoresTest extends TestCase {
  private $baseURL = "http://192.168.160.137:8080/geoserver";

  public function testGetAll() {
    $coverageStore = new CoverageStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    $result = "";
    try {
      $result = $coverageStore->getAll("World_Claim");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
    print_r($result);
  }

  public function testCreate() {
    $coverageStore = new CoverageStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $coverageStore->create([
        "name" => "TestCoverStore2",
        "description" => "This is a test store",
        "workspace" => "World_Claim",
        "enabled" => "true",
        "type" => "GeoTIFF"
      ]);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testGet() {
    $coverageStore = new CoverageStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    $result = "";
    try {
      $result = $coverageStore->get("acme", "Test1");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
    print_r($result);
  }

  public function testUpdate() {
    $coverageStore = new CoverageStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $coverageStore->update("World_Claim", "TestCoverStore2", [
        "name" => "TestCover"
      ]);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testDelete() {
    $coverageStore = new CoverageStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $coverageStore->delete("acme", "test1");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testGeoTiffUpload() {
    $coverageStore = new CoverageStores($this->baseURL);
    $coverageStore->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $coverageStore->geoTiffUpload("World_Claim", "test10", "C:\Users\LoweM\Downloads\wc2.1_2.5m_prec_2010-2018\wc2.1_2.5m_prec_2010-03.tif");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }
}