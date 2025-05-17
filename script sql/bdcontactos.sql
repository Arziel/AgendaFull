-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2025 a las 03:42:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcontactos`
--
CREATE DATABASE IF NOT EXISTS `bdcontactos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdcontactos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `key_cont` int(3) NOT NULL,
  `name_cont` varchar(30) NOT NULL,
  `phone_cont` varchar(13) NOT NULL,
  `address_cont` varchar(50) NOT NULL,
  `email_cont` varchar(30) NOT NULL,
  `key_usr` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`key_cont`, `name_cont`, `phone_cont`, `address_cont`, `email_cont`, `key_usr`) VALUES
(2, 'Abraham Garcia Antonelo', '2721845783', 'Jalapilla Veracruz', 'abrahamgarcia@gmail.com', 1),
(3, 'Jose Angel', '2731286688', 'Chocaman Veracruz', 'jacp@gmail.com', 2),
(8, 'Jaime Poliforum', '2722364834', 'Rio Blanco Veracruz', 'jaimef1@gmail.com', 2),
(10, 'Angel Gutierrez', '2722076403', 'Orizaba junto al rio', 'betrag@gmail.com', 2),
(11, 'Hectorin Agustin', '2711910105', 'Orizaba Veracruz', 'ternurin77@gmail.com', 3),
(13, 'Balatro Balatrez', '2724565434', 'Canada', 'balatro@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `key_usr` int(3) NOT NULL,
  `pw_usr` varchar(30) NOT NULL,
  `type_usr` varchar(20) NOT NULL,
  `name_usr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`key_usr`, `pw_usr`, `type_usr`, `name_usr`) VALUES
(1, 'sw3', 'admin', 'Haziel Pateyro'),
(2, 'sw5', 'viewer', 'Diego Morales'),
(3, 'sw7', 'viewer', 'Abraham Garcia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`key_cont`),
  ADD KEY `key_usr` (`key_usr`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`key_usr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `key_cont` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `key_usr` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `fk_contacto_usuario` FOREIGN KEY (`key_usr`) REFERENCES `usuario` (`key_usr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
