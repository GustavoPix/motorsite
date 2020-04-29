<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato|Space+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROUTE_WEBSITE; ?>/css/style.css">
    <script src="<?php echo ROUTE_WEBSITE; ?>/js/plugins/vue.js"></script>
    <script src="<?php echo ROUTE_WEBSITE; ?>/js/plugins/axios.js"></script>
    <title>Prismacode</title>
</head>

<body>
    <script>
    const globalConfigs = {
        host: "<?php echo ROUTE; ?>",
        hostApi: "<?php echo ROUTE_API; ?>"
    }    
    </script>