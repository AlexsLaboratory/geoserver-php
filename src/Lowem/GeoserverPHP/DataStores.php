<?php

namespace Lowem\GeoserverPHP;

use Lowem\EasyCurl\EasyCurl;
use Lowem\EasyCurl\HTTPRequestException;

class DataStores extends Wrapper {
  public function __construct($baseURL) { parent::__construct($baseURL); }

  /**
   * @throws HTTPRequestException
   */
  public function shapeFileUpload($workspaceName, $store, $absFilePath) {
    if (empty($workspaceName) || empty($store) || empty($absFilePath)) {
      try {
        throw new MissingParamException("Sorry but \"workspaceName\", \"store\", and \"absFilePath\" are required fields.", 404);
      } catch (MissingParamException $e) {
        echo $e->getMessage();
        die($e->getCode());
      }
    }

    $curl = new EasyCurl($this->getBaseURL() . "/workspaces/$workspaceName/datastores/$store/file.shp");
    $curl->setBasicAuth($this->getUsername(), $this->getPassword());
    $file = file_get_contents($absFilePath);
    $curl->put($file, [
      "Content-Type: application/zip"
    ]);
  }
}