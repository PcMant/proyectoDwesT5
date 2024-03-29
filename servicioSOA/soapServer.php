<?php
// Librería nusoap
require_once 'libs/nusoap.php';

// Clase Metodo
require_once 'Metodo.php';

// Crear objeto del soap_server y crear conexión
$server = new soap_server();
$ns = "urn:proyectodwest5";
$server->configureWSDL('proyectoDwesT5', $ns);
$server->schemaTargetNamespace = $ns;

// Funciones registradas
$server->register("Metodo.login", array('user' => 'xsd:string', 'pass' => 'xsd:string'), array('return' => 'xsd:string'), $ns);
$server->register('Metodo.tokenCheck', array('token' => 'xsd:string'), array('return' => 'xsd:boolean'), $ns);

$server->register(
    'Metodo.insertarLibro', 
    array(
        'token' => 'xsd:string', 
        'titulo' => 'xsd:string', 
        'autor' => 'xsd:string', 
        'editorial' => 'xsd:string', 
        'edicion' => 'xsd:string', 
        'isbn' => 'xsd:int'
    ), 
    array('return' => 'xsd:boolean'), $ns);
$server->register('Metodo.updateLibroById', 
    array(
        'token' => 'xsd:string', 
        'id' => 'id:int', 
        'titulo' => 'xsd:string', 
        'autor' => 'xsd:string', 
        'editorial' => 'xsd:string', 
        'edicion' => 'xsd:string', 
        'isbn' => 'xsd:int'
    ), 
    array('return' => 'xsd:boolean'), $ns);

$server->register('Metodo.deleteLibro', array('token' => 'xsd:string', 'id' => 'xsd:int'), array('return' => 'xsd:boolean'), $ns);

$server->register('Metodo.selectTitulo', array('token' => 'xsd:string', 'titulo' => 'xsd:string'), array('return' => 'xsd:string'), $ns);
$server->register('Metodo.selectAutor', array('token' => 'xsd:string','autor' => 'xsd:string'), array('return' => 'xsd:string'), $ns);


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$server->service(file_get_contents($HTTP_RAW_POST_DATA));
$server->service(file_get_contents("php://input"));