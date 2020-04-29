# Site Prismacode

Site criado para prestar serviços de criação de site e softwares para clientes.

## Como usar

- Baixe o repositório
- Coloque os arquivos em **/var/www/html** ou em **htdocs** caso esteja utilizando o apache no Windows
- Em **/var/www** (ou **htdocs**), crie as pastas **configs** e **uploads**
- Em **configs**, crie um arquivo **configs.php** e cole o codigo a seguir setando as variáveis:

```
<?php

const ROUTE = "http://192.168.0.171"; //endereço onde esta o site
const ROUTE_WEBSITE = "http://192.168.0.171/website"; //pasta website do projeto, se nao for diferente, altere o ip
const ROUTE_API = "http://192.168.0.171"; //mesmo endereço do site para este projeto


const SQL_HOSTNAME = "192.168.0.173"; //endereço do banco de dados
const SQL_USERNAME = "phpuser"; //usuario
const SQL_PASSWORD = "pass"; //senha
const SQL_DBNAME = "prismacode_db"; //banco de dados


?>
```

Para criar as tabelas e popular as mesmas, acesse a url */config/table/create_and_set*