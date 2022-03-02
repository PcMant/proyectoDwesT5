<?php
require_once 'Metodo.php';

$metodo = new Metodo();

$login = $metodo->login('admin','admin');
//echo $login;

var_dump($metodo->tokenCheck($login));
//var_dump($metodo->tokenCheck(123));
echo '<hr/>';

//echo var_dump($metodo->insertarLibro($login,'titulo','autor','editorial','edicion','80'));

echo var_dump($metodo->updateLibroById($login,11,'titulo','autor','editorial','edicion','80'));
?>