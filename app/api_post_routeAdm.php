<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/adm/updateContent', function (Request $request, Response $response, array $args) use ($app) {

    if(User::ValidateUser())
    {
        $sql = new Sql();

        $sql->select("UPDATE conteudo_pagina SET text = :text WHERE name = :name and pagina = :pagina",[
            ":name"=>isset($_POST["name"]) ? $_POST["name"] : "",
            ":pagina"=>isset($_POST["pagina"]) ? $_POST["pagina"] : "",
            ":text"=>isset($_POST["text"]) ? $_POST["text"] : ""
        ]);
    }

});


?>