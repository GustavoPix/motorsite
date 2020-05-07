<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/adm/content', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "text",
            "id_section"
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

        $prev = $sql->select("SELECT id FROM content WHERE name = :name AND id_section = :id_section",[
            ":name"=>$_POST["name"],
            ":id_section"=>$_POST["id_section"]
        ]);
        if(count($prev) == 0)
        {
            $sql->select("INSERT INTO content(name,text,id_section) VALUES(:name,:text,:id_section)",[
                ":name"=>$_POST["name"],
                ":text"=>$_POST["text"],
                ":id_section"=>$_POST["id_section"]
            ]);
            $id = $sql->select("SELECT id FROM content WHERE name = :name AND text = :text AND id_section = :id_section ORDER BY id DESC LIMIT 1",[
                ":name"=>$_POST["name"],
                ":text"=>$_POST["text"],
                ":id_section"=>$_POST["id_section"]
            ]);
            $result = array(
                "message"=>"Content Created",
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
                "message"=>"Content already exist",
                "page"=>$prev
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

$app->post('/api/adm/content/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "id",
            "text"
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

        $prev = $sql->select("SELECT * FROM content WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE content SET text = :text WHERE id = :id",[
                ":text"=>$_POST["text"],
                ":id"=>$prev[0]["id"]
            ]);
            $result = array(
                "message"=>"Content updated"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Content not exist",
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

$app->post('/api/adm/content/delete', function (Request $request, Response $response, array $args) use ($app) {

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

        $prev = $sql->select("SELECT id FROM content WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM content WHERE id = :id",[
                ":id"=>$_POST["id"]
            ]);
            $result = array(
                "message"=>"Content deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Content not exist",
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