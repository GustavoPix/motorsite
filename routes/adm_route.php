<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Lists\MainMenu;
use Source\Lists\PaginasMenu;
use Source\Lists\MensagensMenu;
use Source\Lists\SobreMenu;
use Source\Lists\ProjetosMenu;
use Source\Lists\ServicosMenu;
use Source\Sql\Models\Mensagens;
use Source\Sql\Models\Projetos;
use Source\Sql\Models\Content;
use Source\Sql\Models\Equipe;
use Source\Sql\Models\Trabalhos;
use Source\Sql\Models\ProcessoCriacao;
use Source\Sql\Sql;
use Source\Encrypt;
use Source\Sql\Models\User;

$app->get('/adm/login', function (Request $request, Response $response, array $args) use ($app) {

    
    $page = new Page();
    
    $page->setTpl("login",[
    ]);
    
});
$app->get('/adm/paginas/home', function (Request $request, Response $response, array $args) use ($app) {

    if(User::ValidateUser())
    {
        $page = new Page();
        $content = new Content("home");
        $page->setTpl("adm_header",[

        ]);
        $page->setTpl("adm_paginas_home",[
            "mainMenu"=>MainMenu::Menu("paginas"),
            "secondMenu"=>PaginasMenu::Menu("home"),
            "content"=>$content
        ]);
        $page->setTpl("adm_footer",[

        ]);
    }
    else
    {
        return $response->withRedirect('/');
    }
    
});


$app->post('/debug/encrypt', function (Request $request, Response $response, array $args) use ($app) {

    if(User::ValidateUser())
    {
        echo Encrypt::encryptData($_POST["data"]);
    }
    else
    {
        return $response->withRedirect('/');
    }
    
});

?>