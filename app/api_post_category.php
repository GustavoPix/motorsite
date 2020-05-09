<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/category', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name"
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

        $prev = $sql->select("SELECT id FROM categoryProducts WHERE name = :name",[
            ":name"=>$_POST["name"]
        ]);
        if(count($prev) == 0)
        {
        
            $sql->select("INSERT INTO categoryProducts(name) VALUES(:name)",[
                ":name"=>$_POST["name"]
            ]);
            $id = $sql->select("SELECT id FROM categoryProducts WHERE name = :name ORDER BY id DESC LIMIT 1",[
                ":name"=>$_POST["name"]
            ]);
            $result = array(
                "message"=>"Category Created",
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
                "message"=>"Category already exist",
                "category"=>$prev
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

$app->post('/api/category/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "newName"
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

        $prev = $sql->select("SELECT * FROM categoryProducts WHERE name = :name",[
            ":name"=>$_POST["name"]
        ]);
        if(count($prev) > 0)
        {
            $newPrev = $sql->select("SELECT * FROM categoryProducts WHERE name = :name",[
                ":name"=>$_POST["newName"]
            ]);
            if(count($newPrev) == 0)
            {
                $sql->select("UPDATE categoryProducts SET name = :name WHERE id = :id",[
                    ":name"=>$_POST["newName"],
                    ":id"=>$prev[0]["id"]
                ]);
                $result = array(
                    "message"=>"Category updated"
                );
                $response->getBody()->write(json_encode($result));
                return $response
                      ->withHeader('Content-Type', 'application/json')
                      ->withStatus(201);
            }
            else
            {
                $result = array(
                    "message"=>"Category already exist",
                    "category"=>$newPrev
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
                "message"=>"Category not exist",
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


$app->post('/api/category/delete', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name"
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

        $prev = $sql->select("SELECT id FROM categoryProducts WHERE name = :name",[
            ":name"=>$_POST["name"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM categoryProducts WHERE name = :name",[
                ":name"=>$_POST["name"]
            ]);
            $sql->select("DELETE FROM productInCategory WHERE id_category = :id_category",[
                ":id_category"=>$prev[0]['id']
            ]);
            $result = array(
                "message"=>"Category deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Category not exist",
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