-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2018 a las 14:30:09
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ingenieriadev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero`
--

CREATE TABLE `pasajero` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `calificacion_pasajero` int(11) NOT NULL,
  `calificacion_conductor` int(11) NOT NULL,
  `comentario_pasajero` text,
  `comentario_conductor` text,
  `flagcalificacion_pasajero` bit(1),
  `flagcalificacion_conductor` bit(1),
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0'

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `contrasena` varchar(200) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `fechanac` date NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nombreusuario` varchar(50) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id` int(11) NOT NULL,
  `tienevehiculo` tinyint(1) NOT NULL,
  `foto_contenido` longblob NOT NULL,
  `foto_tipo` varchar(5) NOT NULL,
  `imagen_url` varchar(250) NOT NULL,
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`contrasena`, `provincia`, `fechanac`, `apellido`, `telefono`, `nombre`, `nombreusuario`, `ciudad`, `email`, `id`, `tienevehiculo`, `foto_contenido`, `foto_tipo`, `imagen_url`, `borrado_logico`) VALUES
('12345', 'Buenos Aires', '2017-09-14', 'Raverta', '223455555', 'Claudio Marco', 'claudiorav', 'La Plata', 'claudioraverta@hotmail.com', 1, 1, '', '', '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id` int(11) NOT NULL,
  `patente` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `asientosdisp` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `patente`, `marca`, `asientosdisp`, `usuario_id`, `modelo`, `borrado_logico`) VALUES
(15, 'ABC123', 'Ferrari', 2, 1, 'Testarossa', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` int(11) NOT NULL,
  `origen` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `tipo_viaje` varchar(20) NOT NULL,
  `horasalida` datetime NOT NULL,
  `horallegada` datetime NOT NULL,
  `auto_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `borrado_logico` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`id`, `descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`, `borrado_logico`) VALUES
(296, 'prohibido fumar porro', 5000, 'Bariloche', 'Buenos Aires', '3', '2018-07-01 01:00:00', '2018-07-02 10:00:00', 15, 1, 0),
(297, '', 5000, 'La Plata', 'Buenos Aires', '3', '2018-06-15 10:00:00', '2018-06-15 11:11:00', 15, 1, 0),
(298, '', 5000, 'La Plata', 'Buenos Aires', '3', '2018-06-16 10:00:00', '2018-06-16 11:11:00', 15, 1, 0),
(299, '', 5000, 'La Plata', 'Buenos Aires', '3', '2018-06-17 10:00:00', '2018-06-17 11:11:00', 15, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasajero_fk0` (`usuario_id`),
  ADD KEY `pasajero_fk1` (`viaje_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo_fk0` (`usuario_id`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD CONSTRAINT `pasajero_fk0` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `pasajero_fk1` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`id`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_fk0` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
