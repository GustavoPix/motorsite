<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\User;
use Source\Sql\Models\Vaga;
use Source\Sql\Models\Empresa;

$app->get('/api/vagas', function (Request $request, Response $response, array $args) use ($app) {

    
    $result = Vaga::getAll($_GET);


    $response->getBody()->write(json_encode($result));
    return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(201);
    
});





?>