<?php
/**
 * - Este script se encarga de crear un objeto de la clase Alertas y en función
 * de una serie de condiciones se muestra una alerta u otra.
 * - Este script se puede hacer include en cualquier parte del body del HTML.
 * 
 * @autor Juan Molina
 */

require_once 'php/Alertas.php';


$alerta = new Alertas();

/*alerta login*/
if(!empty($_GET['login']) && $_GET['login'] == 'false'){
    echo $alerta->error('El usuario o la contraseña son incorrectos.');
}elseif(!empty($_GET['login']) && $_GET['login'] == 'true'){
    echo $alerta->aviso('Ha iniciado sessión correctamente');
}

/*alerta de insertar o actualizar*/
if(!empty($_GET['up']) && $_GET['up'] == 'false'){
    echo $alerta->error('Ha ocurrido un error, revisa los datos y intentelo de nuevo. Si el problema persiste contacte con soporte.');
}elseif(!empty($_GET['up'])){
    echo $alerta->aviso('La base de datos ha sido actualizada correctamente.');
}

/*Alerta de que no tienes privilegios*/
if ((preg_match('/^insertar.php*/i', basename($_SERVER['REQUEST_URI'])) 
    || preg_match('/^actualizar.php*/i', basename($_SERVER['REQUEST_URI'])) 
    || preg_match('/^consultar.php*/i', basename($_SERVER['REQUEST_URI']))
    || preg_match('/^borrar.php*/i', basename($_SERVER['REQUEST_URI'])))
    && (!empty($_SESSION['token']) && !$clienteSOAP->call('Metodo.tokenCheck', array('token' => $_SESSION['token']))
        || empty($_SESSION['token']))) {
            echo $alerta->error('Su sesión ha expirado o no tienes privilegios para esta opción.');   
    }
?>