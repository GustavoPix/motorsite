<?php if(!class_exists('Rain\Tpl')){exit;}?><p>Nome: <?php echo htmlspecialchars( $content["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
<p>Telefone: <?php echo htmlspecialchars( $content["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
<p>Email: <?php echo htmlspecialchars( $content["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>