<?php

$config = json_decode(file_get_contents('../config.json'), false);
if ($config == false) {
  error_log("Esta mal formateado el json de configuracion");
  die();
}
$GLOBALS['config'] = $config;

$serverError = function (Exception $e) {
  $statusCode = 500;
  $message = 'El servidor exploto, Babel dejo de funcionar sorry 错误 エラー 오류ошибк خطأ त्रुट erreur गलती';
  if ($GLOBALS['config']->apiMode == "debug") {
    $message = "ERROR " . get_class($e) . " : " . $e->getMessage() . " in line: " . $e->getLine() . " on file: " . $e->getFile();
  }
  error_log("ERROR MIOOOOOOOOOOOOOO:" . $message);

  http_response_code($statusCode);
  echo json_encode(['message:' => $message]);
  die();
};
$GLOBALS['serverError'] = $serverError;


// TODO: quiza recrear algo como dd();
