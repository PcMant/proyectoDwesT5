<?php
/**
 * Pequeño script que cierra la sesión.
 * 
 * @author Juan Molina
 */

session_start();

// Cierro la sesión
session_destroy();

// Redirecciono a index donde se encuentra el login
header('Location: ../index.php');
?>