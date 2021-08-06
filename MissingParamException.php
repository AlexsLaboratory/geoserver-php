<?php

namespace Lowem\GeoserverPHP;

use Exception;
use Throwable;

class MissingParamException extends Exception {
  public function __construct($message = "", $code = 0, Throwable $previous = NULL) { parent::__construct($message, $code, $previous); }
}