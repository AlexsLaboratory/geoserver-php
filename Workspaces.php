<?php

namespace Lowem\GeoserverPHP;

use Lowem\EasyCurl\EasyCurl;
use Lowem\EasyCurl\HTTPRequestException;

class Workspaces extends Wrapper {
  public function __construct($baseURL) { parent::__construct($baseURL); }

  /**
   * @throws HTTPRequestException
   */
  public function getAll(): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get();
    return $curl->getExecMessage();
  }

  /**
   * @throws HTTPRequestException
   */
  public function create($workspaceName): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->post("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<workspace>
    <name>{$workspaceName}</name>
</workspace>", [
      "Content-Type: application/xml"
    ]);
    return $curl->getExecMessage();
  }

  /**
   * @throws HTTPRequestException
   */
  public function get($workspaceName): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get();
    return $curl->getExecMessage();
  }

  /**
   * @throws HTTPRequestException
   */
  public function update($currentWorkspaceName, $newWorkspaceName): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$currentWorkspaceName}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->put("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<workspace>
    <name>{$newWorkspaceName}</name>
</workspace>", [
      "Content-Type: application/xml"
    ]);
    return $curl->getExecMessage();
  }

  /**
   * @throws HTTPRequestException
   */
  public function delete($workspaceName, $recurse = FALSE): string {
    $recurseString = $recurse ? "true" : "false";
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}?recurse={$recurseString}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->delete();
    return $curl->getExecMessage();
  }
}