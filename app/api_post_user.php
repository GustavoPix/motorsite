<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/adm/user', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "email"
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
        $prev = $sql->select("SELECT id FROM users WHERE email = :email",[
            ":email"=>$_POST["email"]
        ]);
        if(count($prev) == 0)
        {
        
            $sql->select("INSERT INTO users(name,email,password,enable) VALUES(:name,:email,'1234',:enable)",[
                ":name"=>$_POST["name"],
                ":email"=>$_POST["email"],
                ":enable"=>isset($_POST["enable"]) ? $_POST["enable"] : 1
            ]);
            $id = $sql->select("SELECT id FROM users WHERE email = :email ORDER BY id DESC LIMIT 1",[
                ":email"=>$_POST["email"]
            ]);
            $result = array(
                "message"=>"User Added",
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
                "message"=>"Email already exist"
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

$app->post('/api/adm/user/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "email"
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

        $prev = $sql->select("SELECT * FROM users WHERE email = :email",[
            ":email"=>$_POST["email"]
        ]);
        if(count($prev) > 0)
        {
            if($prev[0]['email'] != $_POST["email"])
            {
                $prevEmail = $sql->select("SELECT id,name,email FROM users WHERE email = :email AND id != :id",[
                    ":email"=>$_POST["email"],
                    ":id"=>$prev[0]["id"]
                ]);
                if(count($prev) > 0)
                {
                    $result = array(
                        "message"=>"New email already exist",
                        "user"=>$prevEmail[0]
                    );
                    $response->getBody()->write(json_encode($result));
                    return $response
                          ->withHeader('Content-Type', 'application/json')
                          ->withStatus(409);
                }
            }
            
            $sql->select("UPDATE users SET email = :email, name = :name WHERE email = :email",[
                ":email"=> $_POST["email"],
                ":name"=>$_POST["name"]
            ]);
            $result = array(
                "message"=>"User updated"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
            
            
        }
        else
        {
            $result = array(
                "message"=>"User not exist",
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
$app->post('/api/adm/user/enable', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "email"
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

        $prev = $sql->select("SELECT * FROM users WHERE email = :email",[
            ":email"=>$_POST["email"]
        ]);
        if(count($prev) > 0)
        {
            
            $sql->select("UPDATE users SET enable = 1 WHERE email = :email",[
                ":email"=> $_POST["email"]
            ]);
            $result = array(
                "message"=>"User Enabled"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
            
            
        }
        else
        {
            $result = array(
                "message"=>"User not exist",
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
$app->post('/api/adm/user/disable', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "email"
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

        $prev = $sql->select("SELECT * FROM users WHERE email = :email",[
            ":email"=>$_POST["email"]
        ]);
        if(count($prev) > 0)
        {
            
            $sql->select("UPDATE users SET enable = 0 WHERE email = :email",[
                ":email"=> $_POST["email"]
            ]);
            $result = array(
                "message"=>"User Disabled"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
            
            
        }
        else
        {
            $result = array(
                "message"=>"User not exist",
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


$app->post('/api/adm/user/delete', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "email"
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

        $prev = $sql->select("SELECT id FROM users WHERE email = :email",[
            ":email"=>$_POST["email"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM users WHERE email = :email",[
                ":email"=>$_POST["email"]
            ]);
            $sql->select("DELETE FROM userSocial WHERE id_user = :id_user",[
                ":id_user"=>$prev[0]["id"]
            ]);
            $sql->select("DELETE FROM userContacts WHERE id_user = :id_user",[
                ":id_user"=>$prev[0]["id"]
            ]);
            $result = array(
                "message"=>"User deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"User not exist",
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

$app->post('/api/adm/user/social', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "url",
            "id_user"
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
        $prevUser = $sql->select("SELECT id FROM users WHERE id = :id",[
            ":id"=>$_POST["id_user"]
        ]);
        if(count($prevUser) > 0)
        {
            $prev = $sql->select("SELECT id FROM userSocial WHERE name = :name AND id_user = :id_user",[
                ":name"=>$_POST["name"],
                ":id_user"=>$_POST["id_user"]
            ]);
            if(count($prev) == 0)
            {
            
                $sql->select("INSERT INTO userSocial(name,url,id_user) VALUES(:name,:url,:id_user)",[
                    ":name"=>$_POST["name"],
                    ":url"=>$_POST["url"],
                    ":id_user"=>$_POST["id_user"]
                ]);
                $id = $sql->select("SELECT id FROM userSocial WHERE name = :name AND url = :url AND id_user = :id_user ORDER BY id DESC LIMIT 1",[
                    ":name"=>$_POST["name"],
                    ":url"=>$_POST["url"],
                    ":id_user"=>$_POST["id_user"],
                ]);
                $result = array(
                    "message"=>"Social Added",
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
                    "message"=>"Social already exist"
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
                "message"=>"User note exist"
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

$app->post('/api/adm/user/social/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "url",
            "id_user"
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

        $prev = $sql->select("SELECT * FROM userSocial WHERE name = :name AND id_user = :id_user",[
            ":name"=>$_POST["name"],
            ":id_user"=>$_POST["id_user"]
        ]);
        if(count($prev) > 0)
        {
            
            $sql->select("UPDATE userSocial SET url = :url WHERE name = :name AND id_user = :id_user",[
                ":url"=> $_POST["url"],
                ":name"=>$_POST["name"],
                ":id_user"=>$_POST["id_user"]
            ]);
            $result = array(
                "message"=>"Social updated"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
            
            
        }
        else
        {
            $result = array(
                "message"=>"Social not exist",
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


$app->post('/api/adm/user/social/delete', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "id_user"
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

        $prev = $sql->select("SELECT id FROM userSocial WHERE name = :name AND id_user = :id_user",[
            ":name"=>$_POST["name"],
            ":id_user"=>$_POST["id_user"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM userSocial WHERE name = :name AND id_user = :id_user",[
                ":name"=>$_POST["name"],
                ":id_user"=>$_POST["id_user"]
            ]);
            $result = array(
                "message"=>"Social deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Social not exist",
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

$app->post('/api/adm/user/contact', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "type",
            "contact",
            "id_user"
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
        $prevUser = $sql->select("SELECT id FROM users WHERE id = :id",[
            ":id"=>$_POST["id_user"]
        ]);
        if($prevUser)
        {
        
        
            $sql->select("INSERT INTO userContacts(name,type,contact,id_user) VALUES(:name,:type,:contact,:id_user)",[
                ":name"=>$_POST["name"],
                ":type"=>$_POST["type"],
                ":contact"=>$_POST["contact"],
                ":id_user"=>$_POST["id_user"]
            ]);
            $id = $sql->select("SELECT id FROM userContacts WHERE name = :name AND type = :type AND contact = :contact AND id_user = :id_user ORDER BY id DESC LIMIT 1",[
                ":name"=>$_POST["name"],
                ":type"=>$_POST["type"],
                ":contact"=>$_POST["contact"],
                ":id_user"=>$_POST["id_user"]
            ]);
            $result = array(
                "message"=>"Contect Added",
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
                "message"=>"User note exist"
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

$app->post('/api/adm/user/contact/update', function (Request $request, Response $response, array $args) use ($app) {

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

        $prev = $sql->select("SELECT * FROM userContacts WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            
            $sql->select("UPDATE userContacts SET name = :name, type = :type, contact = :contact WHERE id = :id",[
                ":name"=>isset($_POST["name"]) ? $_POST["name"] : $prev[0]['name'],
                ":type"=>isset($_POST["type"]) ? $_POST["type"] : $prev[0]['type'],
                ":contact"=>isset($_POST["contact"]) ? $_POST["contact"] : $prev[0]['contact'],
                ":id"=>$prev[0]["id"]
            ]);
            $result = array(
                "message"=>"Contact updated"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
            
            
        }
        else
        {
            $result = array(
                "message"=>"Contact not exist",
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


$app->post('/api/adm/user/contact/delete', function (Request $request, Response $response, array $args) use ($app) {

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

        $prev = $sql->select("SELECT id FROM userContacts WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM userContacts WHERE id = :id",[
                ":id"=>$_POST["id"]
            ]);
            $result = array(
                "message"=>"Contact deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Contact not exist",
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