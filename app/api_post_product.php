<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Models\Page;
use Source\Sql\Models\Projeto;
use Source\Sql\Models\Blog;
use Source\Sql\Models\Message;
use Source\Sql\Sql;
use Source\Sql\Models\User;


$app->post('/api/product', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "name",
            "value"
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

        
        $sql->select("INSERT INTO products(name,cod,value,enable) VALUES(:name,:cod,:value,:enable)",[
            ":name"=>$_POST["name"],
            ":cod"=>isset($_POST["cod"]) ? $_POST["cod"] : 0,
            ":value"=>$_POST["value"],
            ":enable"=>isset($_POST["enable"]) ? $_POST["enable"] : 0
        ]);
        $id = $sql->select("SELECT id FROM products WHERE name = :name AND value = :value ORDER BY id DESC LIMIT 1",[
            ":name"=>$_POST["name"],
            ":value"=>$_POST["value"]
        ]);
        $result = array(
            "message"=>"Product Created",
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

$app->post('/api/product/update', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "id",
            "name",
            "cod",
            "value"
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

        $prev = $sql->select("SELECT * FROM products WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE products SET name = :name, cod = :cod, value = :value, enable = :enable WHERE id = :id",[
                ":name"=>$_POST["name"],
                ":cod"=>$_POST["cod"],
                ":value"=>$_POST["value"],
                ":enable"=>isset($_POST["enable"]) ? $_POST["enable"] : $prev[0]['enable'],
                ":id"=>$prev[0]["id"]
            ]);
            $result = array(
                "message"=>"Product updated"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Product not exist",
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

$app->post('/api/product/enable', function (Request $request, Response $response, array $args) use ($app) {

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

        $prev = $sql->select("SELECT id FROM products WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE products SET enable = 1 WHERE id = :id",[
                ":id"=>$_POST["id"]
            ]);
            $result = array(
                "message"=>"Product posted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Product not exist",
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
$app->post('/api/product/disable', function (Request $request, Response $response, array $args) use ($app) {

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

        $prev = $sql->select("SELECT id FROM products WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("UPDATE products SET enable = 0 WHERE id = :id",[
                ":id"=>$_POST["id"]
            ]);
            $result = array(
                "message"=>"Product unposted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Product not exist",
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
$app->post('/api/product/image', function (Request $request, Response $response, array $args) use ($app) {

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
            if(!isset($_FILES['file']))
            {
                array_push($errors,"file");
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

        $prev = $sql->select("SELECT id FROM products WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {

            $uploaddir = '/var/www/html/website/img/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['file']['name']);
                    
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $sql->select("INSERT INTO imageProduct(url,id_products) VALUES (:url,:id_products)",[
                    ":url"=>basename($_FILES['file']['name']),
                    ":id_products"=>$_POST["id"]
                ]);

                $result = array(
                    "message"=>"Image posted"
                );
                $response->getBody()->write(json_encode($result));
                return $response
                      ->withHeader('Content-Type', 'application/json')
                      ->withStatus(201);

            } 
            else 
            {
                $result = array(
                    "message"=>"Error upload",
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
                "message"=>"Product not exist",
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
$app->post('/api/product/image/delete', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "url"
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

        $prev = $sql->select("SELECT * FROM imageProduct WHERE url = :url",[
            ":url"=>$_POST["url"]
        ]);
        if(count($prev) > 0)
        {

            $file = '/var/www/html/website/img/uploads/' . $prev[0]['url'];
                    
            if (unlink($file)) {
                $sql->select("DELETE FROM imageProduct WHERE url = :url",[
                    ":url"=>$_POST["url"]
                ]);

                $result = array(
                    "message"=>"Image deleted"
                );
                $response->getBody()->write(json_encode($result));
                return $response
                      ->withHeader('Content-Type', 'application/json')
                      ->withStatus(201);

            } 
            else 
            {
                $result = array(
                    "message"=>"Error delete image",
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
                "message"=>"Image not exist",
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

$app->post('/api/product/delete', function (Request $request, Response $response, array $args) use ($app) {

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

        $prev = $sql->select("SELECT id FROM products WHERE id = :id",[
            ":id"=>$_POST["id"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM products WHERE id = :id",[
                ":id"=>$_POST["id"]
            ]);
            $result = array(
                "message"=>"Product deleted"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
        }
        else
        {
            $result = array(
                "message"=>"Product not exist",
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

$app->post('/api/product/category', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "id_product",
            "id_category"
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

        $prev = $sql->select("SELECT id FROM productInCategory WHERE id_product = :id_product AND id_category = :id_category",[
            ":id_product"=>$_POST["id_product"],
            ":id_category"=>$_POST["id_category"]
        ]);
        if(count($prev) == 0)
        {
            $prevProduct = $sql->select("SELECT id FROM products WHERE id = :id",[
                ":id"=>$_POST["id_product"]
            ]);
            $prevCategory = $sql->select("SELECT id FROM categoryProducts WHERE id = :id",[
                ":id"=>$_POST["id_category"]
            ]);
            if(count($prevProduct) > 0 && count($prevCategory) > 0)
            {
                $sql->select("INSERT INTO productInCategory(id_product,id_category) VALUES(:id_product,:id_category)",[
                    ":id_product"=>$_POST["id_product"],
                    ":id_category"=>$_POST["id_category"]
                ]);
                $result = array(
                    "message"=>"Product added in category"
                );
                $response->getBody()->write(json_encode($result));
                return $response
                      ->withHeader('Content-Type', 'application/json')
                      ->withStatus(201);
            }
            else
            {
                $result = array(
                    "message"=>"Error in add product in this category",
                    "product"=>count($prevProduct) > 0,
                    "category"=>count($prevCategory) > 0
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
                "message"=>"Product already in this category",
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
$app->post('/api/product/category/remove', function (Request $request, Response $response, array $args) use ($app) {

    //if(User::ValidateUser())
    if(true)
    {
        $tests = array(
            "id_product",
            "id_category"
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

        $prev = $sql->select("SELECT id FROM productInCategory WHERE id_product = :id_product AND id_category = :id_category",[
            ":id_product"=>$_POST["id_product"],
            ":id_category"=>$_POST["id_category"]
        ]);
        if(count($prev) > 0)
        {
            $sql->select("DELETE FROM productInCategory WHERE id_product = :id_product AND id_category = :id_category",[
                ":id_product"=>$_POST["id_product"],
                ":id_category"=>$_POST["id_category"]
            ]);
            $result = array(
                "message"=>"Product removed of category"
            );
            $response->getBody()->write(json_encode($result));
            return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
            
            
        }
        else
        {
            $result = array(
                "message"=>"Product not already in this category",
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


?>