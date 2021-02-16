-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2021 a las 13:46:13
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_amigo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id`, `id_usuario`, `id_amigo`) VALUES
(22, 2, 1),
(127, 1, 11),
(326, 1, 92),
(327, 1, 2),
(328, 1, 86),
(359, 109, 2),
(360, 109, 11),
(361, 109, 86),
(362, 109, 92),
(387, 86, 92),
(390, 86, 11),
(412, 92, 2),
(413, 92, 1),
(414, 111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `detalle_comentario` varchar(1000) NOT NULL,
  `id_mensaje` int(10) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_usuario`, `detalle_comentario`, `id_mensaje`, `fecha`) VALUES
(121, 25, 'Hola les podes dar de comer una vez al dia ...', 41, '2020-07-09 19:49:47'),
(147, 11, 'Hola Maria podes darles de comer o dos veces o una vez por dia...  ', 41, '2020-07-09 20:33:51'),
(149, 11, 'una vez por semana', 46, '2020-07-09 21:10:10'),
(294, 86, 'Se cambia cada 7 dias', 46, '2021-01-13 14:53:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_usuario` int(20) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_usuario`, `mensaje`, `fecha`) VALUES
(41, 1, 'Hola Quisiera saber si los peces de agua fria comen 2veces por dia', '2020-07-09 00:00:00'),
(42, 11, 'Quisiera saber cada cuanto se les cambia el agua...', '2020-07-05 10:31:18'),
(46, 2, 'Cada cuanto debo cambiar el agua de la pecera de 40x20cm', '2020-07-07 15:27:01'),
(47, 11, 'Quisiera saber si los peces telescopicos no enfocan bien        ', '2020-07-12 10:06:44'),
(169, 11, 'Quisiera saber si los peces resiste ruidos molestos', '2020-11-11 18:13:24'),
(198, 86, 'Quisiera saber como puedo trasladar a mis peces', '2021-01-18 13:44:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajesprivados`
--

CREATE TABLE `mensajesprivados` (
  `id_mensajePrivado` int(10) NOT NULL,
  `id_usuarioEnvia` int(10) NOT NULL,
  `id_usuarioRecibe` int(11) NOT NULL,
  `mensaje` varchar(1000) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajesprivados`
--

INSERT INTO `mensajesprivados` (`id_mensajePrivado`, `id_usuarioEnvia`, `id_usuarioRecibe`, `mensaje`, `fecha`) VALUES
(116, 2, 1, 'hola Maria soy juan enviando un msg', '2020-07-05 19:54:00'),
(117, 2, 16, 'Hola Pepe soy Juan', '2020-07-05 19:55:04'),
(152, 1, 11, 'Prueba de mensaje 2 de florencia', '2020-07-07 11:21:07'),
(154, 1, 2, 'hola Juan soy maria', '2020-07-07 11:27:30'),
(173, 86, 2, 'te mando un msg privado juan pablo soy patricio', '2020-12-31 16:42:42'),
(177, 86, 1, 'Hola Maria Jorgelina como estas?', '2020-12-31 17:34:10'),
(185, 1, 86, 'hola patricio soy maria jorgelina', '0000-00-00 00:00:00'),
(187, 86, 1, 'Hola Maria Soy patricio de nuevo probando ', '2020-12-31 18:41:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `password`, `nombre`, `email`, `imagen`, `alt`) VALUES
(1, '$2y$10$8XyfhIlNCCmEuh/83GUDSuSQuSpV5pWRZ7jVUIE4HtGhDdLqx9vMS', 'Maria Jorgelina', 'maria@gmail.com', '20201215000652.png', '20201213220549.png'),
(2, '$2y$10$sYPRUWe2ij8WJqGtoSLIbOZhVRDlBWhXsVH62SQd0i1dqCZxZ5thC', 'Juan Pablo', 'juan@gmail.com', '20210118131321.png', ''),
(11, '$2y$10$ZrZCWfRmywO/0UQ7MyHMM.Ep6wEGB6voyT.sOsvjItas1UJdKW.dC', 'Mr Bean', 'mr@gmail.com', '20210110170211.jpg', ''),
(86, '$2y$10$BCCAa.r8P1YNKxtx8LFuROwrASEn6W9LYKZKsv4LAcVL2tLHD7hZi', 'Patricio', 'patricio@gmail.com', '20210114204424.jpg', '20201216003641.png'),
(92, '$2y$10$AMTqNFDWjW72NlF0Is90nOQcuikLp8NkUuJPL7mAevv.LM0ep2K2K', 'Brad', 'brad@gmail.com', '20210118131223.png', '20210110135249.png'),
(109, '$2y$10$7/lg4.Qf0q7pliuhrvny5e7cmgE0FjvLBgpX660ZRsrirk3FMDhky', 'flavio', 'flavio@gmail.com', '20210115232613.jpg', '20210115232613.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_mensaje` (`id_mensaje`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_mensaje` (`id_mensaje`),
  ADD KEY `mensaje` (`mensaje`);

--
-- Indices de la tabla `mensajesprivados`
--
ALTER TABLE `mensajesprivados`
  ADD PRIMARY KEY (`id_mensajePrivado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `mensajesprivados`
--
ALTER TABLE `mensajesprivados`
  MODIFY `id_mensajePrivado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_mensaje`) REFERENCES `mensajes` (`id_mensaje`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
