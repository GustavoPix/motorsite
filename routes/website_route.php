<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Content;
use Source\Sql\Sql;

$app->get('/', function (Request $request, Response $response, array $args) use ($app) {

    $contentHome = new Content("home");
    $contentContato = new Content("contato");
    
    $page = new Page();
    $page->setTpl("header",[
    ]);
    $page->setTpl("footer",[
        
    ]);
    
});


?>