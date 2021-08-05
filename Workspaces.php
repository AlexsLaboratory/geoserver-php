<?php

namespace Lowem\GeoserverPHP;

use Lowem\EasyCurl\EasyCurl;

class Workspaces extends Wrapper {
  public function __construct($baseURL) { parent::__construct($baseURL); }

  public function getAll(): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get();
    if ($curl->getErrorMessage()) {
      return $curl->getErrorMessage();
    }
    return $curl->getExecMessage();
  }
}