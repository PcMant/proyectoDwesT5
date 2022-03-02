<?php
session_start();

require_once("php/libs/nusoap.php");

$clienteSOAP = new nusoap_client('../servicioSOA/soapServer.wsdl', true);

// Comprobación de si me encuntro en alguna de las siguientes paginas y tengo un token valido
if ((preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI'])) 
    || preg_match('/^actualizar.php*/i', basename($_SERVER['REQUEST_URI'])) 
    || preg_match('/^consultar.php*/i', basename($_SERVER['REQUEST_URI'])))
    && !empty($_SESSION['token']) && $clienteSOAP->call('Metodo.tokenCheck', array('token' => $_SESSION['token']))) {
        
    // Comprobar el insertado de libro
    if(
        preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI'])) == 1
        && !empty($_GET['titulo']) && isset($_GET['autor']) && isset($_GET['editorial'])
        && isset($_GET['edicion']) && isset($_GET['isbn'])
    ){
        if(empty($_GET['titulo'])) header('Location: insertar.php?up=false');

        $_GET['isbn'] = intval($_GET['isbn']);

        $insert = $clienteSOAP->call('Metodo.insertarLibro', array(
            'token' => $_SESSION['token'],
            'titulo' => $_GET['titulo'],
            'autor' => $_GET['autor'],
            'editorial' => $_GET['editorial'],
            'edicion' => $_GET['edicion'],
            'isbn' => $_GET['isbn']
        ));

        if($insert) {
            header('Location: insertar.php?up=true');
        }else{
            header('Location: insertar.php?up=false');
        }
    }

    // Comprobar la actualicación de libro
     if(
        preg_match('/^actualizar.php*/i', basename($_SERVER['REQUEST_URI'])) == 1
        && !empty($_GET['id'])
        && !empty($_GET['titulo']) && isset($_GET['autor']) && isset($_GET['editorial'])
        && isset($_GET['edicion']) && isset($_GET['isbn'])
     ){
        if(empty($_GET['titulo']) || empty($_GET['id'])) header('Location: actualizar.php?up=false');

        $_GET['id'] = intval($_GET['id']);
        $_GET['isbn'] = intval($_GET['isbn']);

         $update = $clienteSOAP->call('Metodo.updateLibroById', array(
             'token' => $_SESSION['token'],
             'id' => $_GET['id'],
             'token' => $_SESSION['token'],
             'titulo' => $_GET['titulo'],
             'autor' => $_GET['autor'],
             'editorial' => $_GET['editorial'],
             'edicion' => $_GET['edicion'],
             'isbn' => $_GET['isbn']
         ));

         if($update) {
                header('Location: actualizar.php?up=true');
            }else{
                header('Location: actualizar.php?up=false');
            }
     }


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
