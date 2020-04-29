<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Source\Sql\Models\User;
use Source\Sql\Sql;
use Source\Encrypt;

$app->post('/api/login', function (Request $request, Response $response, array $args) use ($app) {

    if(!isset($_POST['email']) || !isset($_POST['password']))
    {
        echo json_encode([
            "success"=>false,
            "message"=>"Email ou senha incompletos"
        ]);
        die();
    }
    else
    {
        $sql = new Sql();
        $email = $_POST["email"];
        $pass = Encrypt::encryptData($_POST["password"]);
        $results = $sql->select("SELECT * FROM users WHERE email = :email AND password = :pass", [
            ':email'=>$email,
            ":pass"=>$pass
        ]);
        //var_dump ($results);
        if(isset($results[0]['name']))
        {
            $id = $results[0]['id'];
            $section = session_id();

            $sql->select("UPDATE users SET session = :session WHERE id = :id", [
                ':session'=>$section,
                ":id"=>$id
            ]);

            echo json_encode([
                "success"=>true
            ]);
        }
        else
        {
            echo json_encode([
                "success"=>false,
                "message"=>"Email ou senha incorretos",
                "pass"=>$pass
            ]);
        }
    }

});



?>