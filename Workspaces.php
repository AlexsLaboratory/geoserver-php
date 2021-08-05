<?php

namespace Lowem\GeoserverPHP;

use Lowem\EasyCurl\EasyCurl;

class Workspaces extends Wrapper {
  public function __construct($baseURL) { parent::__construct($baseURL); }

  public function getAll(): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get();
    if ($curl->getErrorCode()) {
      return $curl->getErrorCode();
    }
    return $curl->getExecMessage();
  }

  public function create($workspaceName): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->post("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<workspace>
    <name>{$workspaceName}</name>
</workspace>", [
      "Content-Type: application/xml"
    ]);
    if ($curl->getErrorCode()) {
      return $curl->getErrorCode();
    }
    return $curl->getExecMessage();
  }

  public function get($workspaceName): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get();
    if ($curl->getErrorCode()) {
      return $curl->getErrorCode();
    }
    return $curl->getExecMessage();
  }

  public function update($currentWorkspaceName, $newWorkspaceName): string {
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$currentWorkspaceName}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->put("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<workspace>
    <name>{$newWorkspaceName}</name>
</workspace>", [
      "Content-Type: application/xml"
    ]);
    if ($curl->getErrorCode()) {
      return $curl->getErrorCode();
    }
    return $curl->getExecMessage();
  }

  public function delete($workspaceName, $recurse = FALSE): string {
    $recurseString = $recurse ? "true" : "false";
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}?recurse={$recurseString}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->delete();
    if ($curl->getErrorCode()) {
      return $curl->getErrorCode();
    }
    return $curl->getExecMessage();
  }
}