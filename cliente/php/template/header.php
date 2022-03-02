<?php 
// Comprobaciones previas
require_once 'php/comprobarAntesHtml.php';


// Comprobación de la página y en función de eso se aplica un title u otro
if(preg_match('/^index.php*/i',basename($_SERVER['REQUEST_URI'])) || preg_match('/cliente*/',basename($_SERVER['REQUEST_URI']))){
    $title= 'Inicio';
}elseif(preg_match('/^insertar.php*/i',basename($_SERVER['REQUEST_URI']))){
    $title= 'Añadir libro';
}elseif(preg_match('/^actualizar.php*/i',basename($_SERVER['REQUEST_URI']))){
    $title= 'Editar libro';
}elseif(preg_match('/^consultar.php*/i',basename($_SERVER['REQUEST_URI']))){
    $title= 'Consultar';
}else{
    $title = '';
}

$title = empty($title) ? '' : $title.' - PcMantBooks';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="initial-scale=1" />
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap/css/bootstrap.min.css" />
    <title><?=$title?></title>
</head>

<body>
    <!--INICO CABECERA-->
    <header id="header" class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-md">
                <a class="navbar-brand logo" href="index.php"><b>PcMant</b>Books</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto my-2 my-lg-0">
                        <li class="nav-item">
                            <a class="nav-link 
                                <?php 
                                    echo preg_match('/^index.php*/i',basename($_SERVER['REQUEST_URI'])) || 
                                    //En este otro comprobar siempre con el nombre de la carpeta que lo contiene, se ha de modificar para adaptarlo
                                    preg_match('/cliente*/',basename($_SERVER['REQUEST_URI'])) ? 'active' : '';
                                ?>" aria-current="page" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo preg_match('/^insertar.php*/i',basename($_SERVER['REQUEST_URI'])) ? 'active' : '';?>" href="insertar.php">Añadir libro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo preg_match('/^actualizar.php*/i',basename($_SERVER['REQUEST_URI'])) ? 'active' : '';?>" href="actualizar.php" tabindex="-1" aria-disabled="true">Editar libro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo preg_match('/^consultar.php*/i',basename($_SERVER['REQUEST_URI'])) ? 'active' : '';?>" href="consultar.php" tabindex="-1" aria-disabled="true">Consultar</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?=empty($_SESSION['usuario']) && empty($_SESSION['password']) ? 'Invitado' : $_SESSION['usuario']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="index.php">Iniciar sesión</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="php/logout.php">Cerrar sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- FIN CABECERA -->

    <!-- Inicio de contenido -->
    <main id="main" class="container container-md bg-light mt-2 p-5">
        
    <?php require_once 'php/template/alerta.php';// Alertas ?>