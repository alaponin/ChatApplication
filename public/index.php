<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '../app/vendor/autoload.php';

$app = new \Slim\App;

require_once '../app/routes/api.php';


$app->run();