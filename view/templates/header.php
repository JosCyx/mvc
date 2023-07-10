<!-- parte inicial del documento-->
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->  
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/styles.css" rel="stylesheet">       
        <!-- FONT AWESOME -->
        <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" 
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" 
        crossorigin="anonymous">

        <style>
            #izquierda {
                float: left;
                width: 25%;
                height: 800px;
                background-image: url(imagen_izquierda.jpg);
                background-size: cover;
                background-color: #cee6ff;
                border: 1px solid black;
            }

            #derecha {
                float: right;
                width: 25%;
                height: 800px;
                background-image: url(imagen_derecha.jpg);
                background-size: cover;
                background-color: #cee6ff;
                border: 1px solid black;
            }

            #centro {
                margin: 0 auto;
                width: 50%;
                height: 800px;
                text-align: center;
                padding-top: 50px;
                background-size: cover;
                background-color: #cee6ff;
                border: 1px solid black;
            }

            
            #izquierdatexto {
                float: left;
                width: 25%;
                height: 350px;
                background-size: cover;
                background-color: #cee6ff;
                border: 1px solid black;
            }

            #derechatexto {
                float: right;
                width: 25%;
                height: 350px;
                background-size: cover;
                background-color: #cee6ff;
                border: 1px solid black;
            }
            #centrotexto{
                margin: 0 auto;
                width: 50%;
                height: 350px;
                text-align: center;
                padding-top: 50px;
                background-size: cover;
                background-color: #cee6ff;
                border: 1px solid black;
            }

            img {
                float: right;
                margin-right: 10px; 
                
            }

            .mi-div {
                border-top: 1px solid black;
            }

            .fondo {
                background-image: url('assets/images/fondo.jpg');
                background-size:cover;
            }
            
        </style>
        <title>Mi Veterinaria</title>
    </head> 

    <body>
        <nav class="barraNavegacion navbar navbar-expand-md navbar-dark fixed-top">
            <a class="navbar-brand" href="index.php">Mi Veterinaria</a>
            <ul class="navbar-nav mr-auto">
                <!--crear enlaces segùn perfil de usuario-->
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=Citas&f=index">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=Productos&f=index">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=Servicios&f=index">Servicios</a></li>


                
                <?php if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '1'){?>
                    <li class="nav-item"><a class="nav-link" href="index.php?c=Clientes&f=index">Usuarios</a></li>
                <?php } else if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '2'){?>   
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php?c=Info">Quienes somos</a></li>
                <?php } else{?>   
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php?c=Info">Veterinario</a></li>
                <?php }?>
                      


                    

            </ul>  
            <ul class="navbar-nav ml-auto">
                <li class="nav-item my-auto"><span style="color:white"><?php 
                if (isset($_SESSION[NAME_USER])) {
                    echo $_SESSION['name'];
                }else{
                    echo 'Usuario';
                }?> </span></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=index&f=index&p=login">Login</a></li>

            </ul>
            <?php
            if(empty($_SESSION['role'])){
                echo '<a class="btn btn-outline-info" href="index.php?c=auth&f=register">Registrate</a>';
            }
            if (isset($_SESSION['name']) && isset($_SESSION['role'])) {
                echo '<a class="btn btn-outline-danger" href="index.php?c=auth&f=logout">Cerrar sesión</a>';
            }
            ?>
        </nav>
        <div class="fondo">
        <h1 class="jumbotron text-center titNivel1">
            <i class="fab fa-shopify"></i>
            Mi Veterinaria </h1>
    </div>

        <?php
        if (!isset($_SESSION)) {
            session_start();
        };
        if (!empty($_SESSION['mensaje'])) {
            ?>
            <div class="mt-2 alert alert-<?php echo $_SESSION['color']; ?>
             alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>  
            </div>
            <?php
            unset($_SESSION['mensaje']);
            unset($_SESSION['color']);
        }//end if 
        ?>
        