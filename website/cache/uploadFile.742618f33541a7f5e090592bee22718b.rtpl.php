<?php if(!class_exists('Rain\Tpl')){exit;}?><form enctype="multipart/form-data" action="/api/product/image" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="text" placeholder="ID" name="id">
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    Enviar esse arquivo: <input name="file" type="file" />
    <input type="submit" value="Enviar arquivo" />
</form>