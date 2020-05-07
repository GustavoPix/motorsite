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
        $sections = $sql->select("SELECT * FROM section WHERE id_page = :id_page ORDER BY position",[
            ":id_page"=>$pageSql[0]['id']
        ]);
        
        $page->setTpl("header",[
        ]);

        foreach($sections as $section)
        {
            
            $page->setTpl($section['template'],[
            ]);
        }
        
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