<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/adm/page', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "link"
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

        $prev = $sql->select("SELECT id FROM page WHERE link = :link",[
            ":link"=>$_POST["link"]
        ]);
        if(count($prev) == 0)
        {
            $sql->select("INSERT INTO page(name,link,posted) VALUES(:name,:link,:posted)",[
                ":name"=>$_POST["name"],
                ":link"=>$_POST["link"],
                ":posted"=>0
            ]);
            $id = $sql->select("SELECT id FROM page WHERE link = :link",[
                ":link"=>$_POST["link"]
            ]);
            $result = array(
                "message"=>"Page Created",
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
                "message"=>"Page already exist",
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
$app->post('/api/adm/page/post', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "link"
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

        $prev = $sql->select("SELECT id FROM page WHERE link = :link",[
            ":link"=>$_POST["link"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE page SET posted = 1 WHERE link = :link",[
                ":link"=>$_POST["link"]
            ]);
            $result = array(
                "message"=>"Page posted"
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
$app->post('/api/adm/page/unpost', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "link"
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

        $prev = $sql->select("SELECT id FROM page WHERE link = :link",[
            ":link"=>$_POST["link"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE page SET posted = 0 WHERE link = :link",[
                ":link"=>$_POST["link"]
            ]);
            $result = array(
                "message"=>"Page unposted"
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
$app->post('/api/adm/page/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "link",
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

        $prev = $sql->select("SELECT * FROM page WHERE link = :link",[
            ":link"=>$_POST["link"]
        ]);
        if(count($prev) > 0)
        {
            if(isset($_POST["newLink"]))
            {
                $prevNew = $sql->select("SELECT id FROM page WHERE link = :link",[
                    ":link"=>$_POST["newLink"]
                ]);

                if(count($prevNew) > 0)
                {
                    $result = array(
                        "message"=>"New link already exist",
                    );
                    $response->getBody()->write(json_encode($result));
                    return $response
                          ->withHeader('Content-Type', 'application/json')
                          ->withStatus(409);
                    die();
                }
            }
            $sql->select("UPDATE page SET link = :link, name = :name WHERE id = :id",[
                ":link"=>isset($_POST["newLink"]) ? $_POST["newLink"] : $_POST["link"],
                ":name"=>$_POST["name"],
                ":id"=>$prev[0]["id"]
            ]);
            $result = array(
                "message"=>"Page updated",
                "link"=>isset($_POST["newLink"]) ? $_POST["newLink"] : $_POST["link"]
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
$app->post('/api/adm/page/delete', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "link"
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

        $prev = $sql->select("SELECT id FROM page WHERE link = :link",[
            ":link"=>$_POST["link"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM page WHERE link = :link",[
                ":link"=>$_POST["link"]
            ]);
            $result = array(
                "message"=>"Page deleted"
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