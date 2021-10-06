<?php

use Lowem\GeoserverPHP\DataStores;
use Lowem\EasyCurl\HTTPRequestException;
use PHPUnit\Framework\TestCase;

class DataStoresTest extends TestCase {
  private $baseURL = "http://192.168.160.137:8080/geoserver";

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
