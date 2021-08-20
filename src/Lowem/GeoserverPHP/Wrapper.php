<?php

namespace Lowem\GeoserverPHP;

class Wrapper {
  private $baseURL;
  private $username = "";
  private $password = "";

  public function __construct($baseURL) {
    $this->baseURL = $baseURL . "/geoserver/rest";
  }

  public function setBasicAuth($username, $password) {
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