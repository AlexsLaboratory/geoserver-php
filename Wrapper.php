<?php

namespace Lowem\GeoserverPHP;
require_once "vendor/autoload.php";

class Wrapper {
  private string $baseURL = "";
  private string $username = "";
  private string $password = "";

  public function __construct($baseURL) {
    $this->baseURL = $baseURL . "/geoserver/rest";
  }

  public function setBasicAuth($username, $password): void {
    $this->username = $username;
    $this->password = $password;
  }

  /**
   * @return string
   */
  protected function getUsername(): string {
    return $this->username;
  }

  /**
   * @return string
   */
  protected function getPassword(): string {
    return $this->password;
  }

  /**
   * @return string
   */
  protected function getBaseURL(): string {
    return $this->baseURL;
  }
}