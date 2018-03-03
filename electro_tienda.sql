-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2017 a las 23:42:24
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `electro_tienda`
--
CREATE DATABASE IF NOT EXISTS `electro_tienda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `electro_tienda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cab_factura`
--

DROP TABLE IF EXISTS `cab_factura`;
CREATE TABLE `cab_factura` (
  `id_factura` int(11) NOT NULL,
  `fact2cliente` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profesion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_factura`
--

DROP TABLE IF EXISTS `det_factura`;
CREATE TABLE `det_factura` (
  `id_detalle` int(11) NOT NULL,
  `det2fact` int(11) NOT NULL,
  `det2prod` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cp` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('fac','env') COLLATE utf8_spanish_ci NOT NULL,
  `direcc2cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `img` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cab_factura`
--
ALTER TABLE `cab_factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `fact2cliente` (`fact2cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `usuario` (`username`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `det_factura`
--
ALTER TABLE `det_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `det2fact` (`det2fact`),
  ADD KEY `det2prod` (`det2prod`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `direcc2cliente` (`direcc2cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `det_factura`
--
ALTER TABLE `det_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cab_factura`
--
ALTER TABLE `cab_factura`
  ADD CONSTRAINT `cab_factura_ibfk_1` FOREIGN KEY (`fact2cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_factura`
--
ALTER TABLE `det_factura`
  ADD CONSTRAINT `det_factura_ibfk_2` FOREIGN KEY (`det2prod`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `det_factura_ibfk_3` FOREIGN KEY (`det2fact`) REFERENCES `cab_factura` (`id_factura`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`direcc2cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
