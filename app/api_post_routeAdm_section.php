<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/adm/section', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "template",
            "id_page",
            "position"
        );
        
        $errors = array();
        foreach($tests as $t)
        {
            if(!isset($_POST[$t]))
            {
                array_push($errors,$t);
            }
        }
        if(count($errors) > 0)
        {
            $result = array(
                "message"=>"Bad request",
                "dataForbidden"=>$errors
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(403);
            die();
        }
        $sql = new Sql();

        
        $sql->select("INSERT INTO section(name,template,id_page,position) VALUES(:name,:template,:id_page,:position)",[
            ":name"=>$_POST["name"],
            ":template"=>$_POST["template"],
            ":id_page"=>$_POST["id_page"],
            ":position"=>$_POST["position"]
        ]);
        $id = $sql->select("SELECT id FROM section WHERE name = :name AND template = :template AND id_page = :id_page ORDER BY id DESC LIMIT 1",[
            ":name"=>$_POST["name"],
            ":template"=>$_POST["template"],
            ":id_page"=>$_POST["id_page"]
        ]);
        $result = array(
            "message"=>"Section Created",
            "id"=>$id[0]["id"]
        );
        $response->getBody()->write(json_encode($result));
        return $response
              ->withHeader('Content-Type', 'application/json')
              ->withStatus(201);
        
        

        
    }
    else
    {
        $result = array(
            "message"=>"Login unauthorized"
        );
        $response->getBody()->write(json_encode($result));
        return $response
              ->withHeader('Content-Type', 'application/json')
              ->withStatus(401);
    }

});

$app->post('/api/adm/section/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "template",
            "id_page",
            "position",
            "id"
        );
        
        $errors = array();
        foreach($tests as $t)
        {
            if(!isset($_POST[$t]))
            {
                array_push($errors,$t);
            }
        }
        if(count($errors) > 0)
        {
            $result = array(
                "message"=>"Bad request",
                "dataForbidden"=>$errors
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(403);
            die();
        }
        $sql = new Sql();

        $prev = $sql->select("SELECT * FROM section WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE section SET name = :name, template = :template, id_page = :id_page, position = :position WHERE id = :id",[
                ":name"=>$_POST["name"],
                ":template"=>$_POST["template"],
                ":id_page"=>$_POST["id_page"],
                ":position"=>$_POST["position"],
                ":id"=>$prev[0]["id"]
            ]);
            $result = array(
                "message"=>"Section updated"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Page not exist",
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(409);
        }

        
    }
    else
    {
        $result = array(
            "message"=>"Login unauthorized"
        );
        $response->getBody()->write(json_encode($result));
        return $response
              ->withHeader('Content-Type', 'application/json')
              ->withStatus(401);
    }

});

$app->post('/api/adm/section/delete', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "id"
        );
        
        $errors = array();
        foreach($tests as $t)
        {
            if(!isset($_POST[$t]))
            {
                array_push($errors,$t);
            }
        }
        if(count($errors) > 0)
        {
            $result = array(
                "message"=>"Bad request",
                "dataForbidden"=>$errors
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(403);
            die();
        }
        $sql = new Sql();

        $prev = $sql->select("SELECT id FROM section WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM section WHERE id = :id",[
                ":id"=>$_POST["id"]
            ]);
            $result = array(
                "message"=>"Section deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Page not exist",
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(409);
        }

        
    }
    else
    {
        $result = array(
            "message"=>"Login unauthorized"
        );
        $response->getBody()->write(json_encode($result));
        return $response
              ->withHeader('Content-Type', 'application/json')
              ->withStatus(401);
    }

});


?>