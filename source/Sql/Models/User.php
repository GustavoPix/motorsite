<?php
namespace Source\Sql\Models;

use Source\Sql\Sql;

class User{

    private $content = array();

    public function __construct($page)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM conteudo_pagina WHERE pagina = :pagina",[
            ":pagina"=>$page
        ]);

        foreach($data as $line)
        {
            $this->content[$line["name"]] = $line["text"];
        }
    }

    public static function ValidateUser()
    {
        $sql = new Sql();
        return isset($sql->select("SELECT id FROM users WHERE session = :session",[
            ":session"=>session_id()
        ])[0]);
    } 

}

?>