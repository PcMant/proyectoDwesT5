<?php
session_start();

require_once("php/libs/nusoap.php");

$clienteSOAP = new nusoap_client('../servicioSOA/soapServer.wsdl', true);


// Comprobación de si me encuntro en alguna de las siguientes paginas y tengo un token valido
if ((preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI'])) 
    || preg_match('/^actualizar.php*/i', basename($_SERVER['REQUEST_URI'])) 
    || preg_match('/^consultar.php*/i', basename($_SERVER['REQUEST_URI'])))
    && !empty($_SESSION['token']) && $clienteSOAP->call('Metodo.tokenCheck', array('token' => $_SESSION['token']))) {

        
        var_dump(
            preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI']))
        && !empty($_GET['titulo']) && isset($_GET['autor']) && isset($_GET['editorial'])
        && isset($_GET['edicion']) && isset($_GET['isbn']) && is_int($_GET['autor'])
        );
    // Comprobar el insertado de libro
    if(
        preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI']))
        && !empty($_GET['titulo']) && iseet($_GET['autor']) && iseet($_GET['editorial'])
        && iseet($_GET['edicion']) && iseet($_GET['isbn']) && is_int($_GET['autor'])
    ){
        $insert = $clienteSOAP->call('Metodo.insertarLibro', array(
            'token' => $_SESSION['token'],
            'titulo' => $_GET['titulo'],
            'autor' => $_GET['autor'],
            'editorial' => $_GET['editorial'],
            'isbn' => $_GET['isbn']
        ));

        header('Location: insertar.php?up='.$insert ? 'true' : 'false');

    }elseif(
        preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI']))
        && (empty($_GET['titulo']) || !iseet($_GET['autor']) || !iseet($_GET['editorial'])
        || !iseet($_GET['edicion']) || !iseet($_GET['isbn']) || !is_int($_GET['autor']))
    ){
        //header('Location: insertar.php?up=false');
    }

    // Comprobar la actualicación de libro
    // if(
    //     preg_match('/^actualizar.php*/i', basename($_SERVER['REQUEST_URI']))
    //     && !empty($_GET['id']) && is_int($_GET['id'])
    //     && !empty($_GET['titulo']) && iseet($_GET['autor']) && iseet($_GET['editorial'])
    //     && iseet($_GET['edicion']) && iseet($_GET['isbn']) && is_int($_GET['autor'])
    // ){
    //     $insert = $clienteSOAP->call('Metodo.updateLibro', array(
    //         'token' => $_SESSION['token'],
    //         'id' => $_GET['id'],
    //         'titulo' => $_GET['titulo'],
    //         'autor' => $_GET['autor'],
    //         'editorial' => $_GET['editorial'],
    //         'isbn' => $_GET['isbn']
    //     ));

    //     header('Location: actualizar.php?up='.$insert ? 'true' : 'false');

    // }else{
    //     header('Location: actualizar.php?up=false');
    // }


    // Comprobar consulta de libro

}else{

    // Comprobando si se ha logeado correctamente
    if (!empty($_GET['usuario']) && !empty($_GET['password'])) {
        $_SESSION['token'] = '';
        $_SESSION['usuario'] = '';

        $token = ($clienteSOAP->call('Metodo.login', array('user' => $_GET['usuario'], 'pass' => $_GET['password'])));
        $_SESSION['token'] = $token;

        if (!$clienteSOAP->call('Metodo.tokenCheck', array('token' => $_SESSION['token']))) {
            header('Location: index.php?login=false');
        } else {
            $_SESSION['usuario'] = $_GET['usuario'];
            header('Location: index.php?login=true');
        }
    } elseif ((isset($_GET['usuario']) && empty($_GET['usuario'])) || (isset($_GET['password']) && empty($_GET['password']))) {
        $$_SESSION['token'] = '';
        $_SESSION['usuario'] = '';
        header('Location: index.php?login=false');
    }

}
