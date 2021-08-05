<?php

use Lowem\GeoserverPHP\Workspaces;
use PHPUnit\Framework\TestCase;

class WorkspacesTest extends TestCase {
  public function testGetAll() {
    $workspace = new Workspaces("http://192.168.160.137:8080");
    $workspace->setBasicAuth("admin", "geoserver");
    $result = $workspace->getAll();
    $this->assertNotEmpty($result);
    print_r($result);
  }
}
