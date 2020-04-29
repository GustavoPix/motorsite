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

$app->get('/{link}', function (Request $request, Response $response, array $args) use ($app) {

    $contentHome = new Content("home");
    $contentContato = new Content("contato");
    
    $page = new Page();
    $sql = new Sql();

    $pageSql = $sql->select("SELECT * FROM page WHERE link = :link and posted = 1",[
        ":link"=>$args["link"]
    ]);
    if(count($pageSql) > 0)
    {

        
        $page->setTpl("header",[
        ]);
        $page->setTpl("namePage",[
            "name"=>$pageSql[0]['name']
        ]);
        $page->setTpl("footer",[
        ]);
    }
    else
    {
        $page->setTpl("error404",[
        ]);
    }
    
});


?>