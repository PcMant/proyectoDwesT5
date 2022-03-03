-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-03-2022 a las 20:37:43
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
DROP DATABASE IF EXISTS `biblioteca`;
CREATE DATABASE `biblioteca`;
USE `biblioteca`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8_bin NOT NULL,
  `editorial` varchar(255) COLLATE utf8_bin NOT NULL,
  `edicion` varchar(255) COLLATE utf8_bin NOT NULL,
  `isbn` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `editorial`, `edicion`, `isbn`) VALUES
(1, 'titulo', 'autor', 'editorial', 'edicion', 80),
(2, 'titulo', 'autor', 'editorial', 'edicion', 80),
(3, 'prueba1', 'autor', 'editorial', 'espasa', 123),
(4, 'prueba1', 'autor', 'editorial', 'espasa', 123),
(5, 'prueba1', 'autor', 'editorial', 'espasa', 123),
(6, 'prueba1', 'autor', 'editorial', 'espasa', 123),
(7, 'prueba1', 'autor', 'editorial', 'espasa', 123),
(8, 'abc', '', '', '', 0),
(9, 'libro', '', '', '', 0),
(10, 'aaaaaa', '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8_bin NOT NULL,
  `pass` varchar(255) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`, `token`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'bbfc33713b092a4019276994da732a493a1d7eb7');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
