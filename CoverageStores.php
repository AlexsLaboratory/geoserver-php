<?php

namespace Lowem\GeoserverPHP;

use Lowem\EasyCurl\EasyCurl;
use Lowem\EasyCurl\HTTPRequestException;

class CoverageStores extends Wrapper {
  public function __construct($baseURL) { parent::__construct($baseURL); }

  /**
   * @throws HTTPRequestException
   */
  public function getAll($workspaceName): string {
    if (empty($workspaceName)) {
      try {
        throw new MissingParamException("Sorry but \"workspaceName\" is a required field.", 404);
      } catch (MissingParamException $e) {
        echo $e->getMessage();
        die($e->getCode());
      }
    }
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}/coveragestores");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get([
      "Accept: application/json"
    ]);
    return $curl->getExecMessage();
  }

  /**
   * @throws HTTPRequestException
   */
  public function create($data = []) {
    $requireParams = [
      "name",
      "description",
      "workspace",
      "enabled",
      "type"
    ];
    foreach ($requireParams as $value) {
      if (!array_key_exists($value, $data) || empty($data[$value])) {
        try {
          throw new MissingParamException("Sorry but \"{$value}\" is a required field.", 404);
        } catch (MissingParamException $e) {
          echo $e->getMessage();
          die($e->getCode());
        }
      }
    }
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$data["workspace"]}/coveragestores");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $data = "{
    \"coverageStore\": {
        \"name\": \"{$data["name"]}\",
        \"description\": \"{$data["description"]}\",
        \"workspace\": \"{$data["workspace"]}\",
        \"enabled\": \"{$data["enabled"]}\",
        \"type\": \"{$data["type"]}\"
    }
  }";
    $curl->post($data, [
      "Content-Type: application/json",
      "Accept: application/json"
    ]);
  }

  /**
   * @throws HTTPRequestException
   */
  public function get($workspaceName, $store) {
    if (empty($workspaceName) || empty($store)) {
      try {
        throw new MissingParamException("Sorry but \"workspaceName\" and \"store\" are required fields.", 404);
      } catch (MissingParamException $e) {
        echo $e->getMessage();
        die($e->getCode());
      }
    }
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}/coveragestores/{$store}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $curl->get([
      "Accept: application/json"
    ]);
    return $curl->getExecMessage();
  }

  /**
   * @throws HTTPRequestException
   */
  public function update($workspaceName, $store, $data = []) {
    $acceptedParams = [
      "name",
      "description",
      "workspace",
      "enabled",
      "type",
      "__default",
      "url"
    ];

    if (empty($workspaceName) || empty($store)) {
      try {
        throw new MissingParamException("Sorry but \"workspaceName\" and \"store\" are required fields.", 404);
      } catch (MissingParamException $e) {
        echo $e->getMessage();
        die($e->getCode());
      }
    }

    foreach ($data as $key => $value) {
      if (!in_array($key, $acceptedParams)) {
        try {
          throw new MissingParamException("Sorry but \"{$key}\" is not a valid field.", 404);
        } catch (MissingParamException $e) {
          echo $e->getMessage();
          die($e->getCode());
        }
      }
    }
    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}/coveragestores/{$store}");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $jsonData = json_encode($data);
    $data = "{
      \"coverageStore\": $jsonData
    }";
    $curl->put($data, [
      "Content-Type: application/json",
      "Accept: application/json"
    ]);
  }

  /**
   * @throws HTTPRequestException
   */
  public function geoTiffUpload($workspaceName, $store, $absFilePath) {
    if (empty($workspaceName) || empty($store) || empty($absFilePath)) {
      try {
        throw new MissingParamException("Sorry but \"workspaceName\", \"store\", and \"absFilePath\" are required fields.", 404);
      } catch (MissingParamException $e) {
        echo $e->getMessage();
        die($e->getCode());
      }
    }

    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/{$workspaceName}/coveragestores/{$store}/file.geotiff");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $file = file_get_contents($absFilePath);
    $curl->put($file, [
      "Content-Type: image/tiff"
    ]);
  }
}