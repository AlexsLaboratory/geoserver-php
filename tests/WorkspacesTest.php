<?php

use Lowem\GeoserverPHP\Workspaces;
use PHPUnit\Framework\TestCase;
use Lowem\EasyCurl\HTTPRequestException;

class WorkspacesTest extends TestCase {
  private $baseURL = "http://192.168.160.137:8080/geoserver";

  public function testGetAll() {
    $workspace = new Workspaces($this->baseURL);
    $workspace->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    $result = "";
    try {
      $result = $workspace->getAll();
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    print_r($result);
    self::assertFalse($error);
  }

  public function testCreate() {
    $workspace = new Workspaces($this->baseURL);
    $workspace->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $workspace->create("Test1");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testGet() {
    $workspace = new Workspaces($this->baseURL);
    $workspace->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    $result = "";
    try {
      $result = $workspace->get("Test1");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    print_r($result);
    self::assertFalse($error);
  }

  public function testUpdate() {
    $workspace = new Workspaces($this->baseURL);
    $workspace->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $workspace->update("Test1", "Test12");
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }

  public function testDelete() {
    $workspace = new Workspaces($this->baseURL);
    $workspace->setBasicAuth("admin", "geoserver");
    $error = FALSE;
    try {
      $result = $workspace->delete("Test12", TRUE);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error);
  }
}
