<?php
namespace Source\Sql\Models;

use Source\Sql\Sql;

class Content{

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

    public function GetContent($name)
    {
        return isset($this->content[$name]) ? $this->content[$name] : "Error";
        //$sql = new Sql();
        //return $sql->select("SELECT * FROM conteudo_pagina WHERE name = :name and pagina = :pagina",[
        //    ":name"=>$name,
        //    ":pagina"=>$page
        //]);
    } 

}

?>