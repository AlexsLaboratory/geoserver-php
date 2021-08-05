<?php

use Lowem\GeoserverPHP\Workspaces;
use PHPUnit\Framework\TestCase;

class WorkspacesTest extends TestCase {
  public function testGetAll() {
    $workspace = new Workspaces("http://192.168.160.137:8080");
    $workspace->setBasicAuth("admin", "geoserver");
    $result = $workspace->getAll();
    self::assertIsNotNumeric($result);
    print_r($result);
  }

  public function testCreate() {
    $workspace = new Workspaces("http://192.168.160.137:8080");
    $workspace->setBasicAuth("admin", "geoserver");
    $result = $workspace->create("Test1");
    self::assertIsNotNumeric($result);
  }

  public function testGet() {
    $workspace = new Workspaces("http://192.168.160.137:8080");
    $workspace->setBasicAuth("admin", "geoserver");
    $result = $workspace->get("Test1");
    self::assertIsNotNumeric($result);
    print_r($result);
  }

  public function testUpdate() {
    $workspace = new Workspaces("http://192.168.160.137:8080");
    $workspace->setBasicAuth("admin", "geoserver");
    $result = $workspace->update("Test1", "Test12");
    self::assertIsNotNumeric($result);
  }

  public function testDelete() {
    $workspace = new Workspaces("http://192.168.160.137:8080");
    $workspace->setBasicAuth("admin", "geoserver");
    $result = $workspace->delete("Test12", TRUE);
    self::assertIsNotNumeric($result);
  }
}
