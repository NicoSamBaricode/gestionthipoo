-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2021 a las 18:10:44
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_thi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividades` int(255) NOT NULL,
  `identificador` text NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `horas_dedicadas` int(150) NOT NULL,
  `color_act` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividades`, `identificador`, `nombre`, `descripcion`, `horas_dedicadas`, `color_act`) VALUES
(1, '123a', 'prueba2a', 'actividad1a', 13, 'red'),
(2, '12345', 'Instituto2Balseiro', 'Tareas de docencia', 150, 'blue'),
(3, '12', 'grafico', 'prueba grafico', 20, ''),
(4, '1223', 'Color', 'prueba de color', 123, '#5dd5b3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente`
--

CREATE TABLE `agente` (
  `id_agente` int(50) NOT NULL,
  `nombre` int(50) NOT NULL,
  `ubicacion` int(50) NOT NULL,
  `division` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyectos` int(255) NOT NULL,
  `identificador` text DEFAULT NULL,
  `nombre` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `tema` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `sector` text DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `fecha_realizado` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` text NOT NULL,
  `archivo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyectos`, `identificador`, `nombre`, `fecha_inicio`, `tema`, `descripcion`, `sector`, `responsable`, `fecha_realizado`, `observaciones`, `estado`, `archivo`) VALUES
(2, '123', 'loop chf', '2021-02-18', 'compras', 'no tiene', 'labthi', '2', '2021-02-18', 'no tiene', 'Pendiente', NULL),
(5, '1234', 'sistema de gestion', '2021-02-05', 'programacion', 'esto es una descripcion', 'lab thi', '2', '2021-02-25', '', 'Revisar', NULL),
(10, 'lc1', 'loop chico', '2021-02-26', 'varios', 'sin descripción', 'thi', '2', '2021-02-25', 'asd', 'En proceso', NULL),
(13, '412', 'ulti', '2021-02-16', 'asdas', 'asdas', 'asdas', '27', '2021-02-12', 'ASas', 'Cancelado', NULL),
(14, '1234', 'aprobarEfip', '2021-02-23', 'efip', 'efip', 'efip', '2', '2021-02-23', 'Aprovado', 'Realizado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tareas` int(50) NOT NULL,
  `nombre` text DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `f_inicio` date NOT NULL,
  `f_final` date DEFAULT NULL,
  `Estado` varchar(250) NOT NULL,
  `id_proyectos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tareas`, `nombre`, `descripcion`, `responsable`, `f_inicio`, `f_final`, `Estado`, `id_proyectos`) VALUES
(3, 'tarea2', 'adas', '21', '2021-02-19', '2021-02-26', 'Pendiente', '2'),
(16, 'elicitacion', 'adas', '22', '2021-02-04', '2021-02-24', 'Pendiente', '5'),
(17, 'verif', 'asdas', '22', '2021-02-25', '2021-02-24', 'Realizada', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(100) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `mail` varchar(20) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `pasword` varchar(8) DEFAULT NULL,
  `imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `mail`, `alias`, `rol`, `pasword`, `imagen`) VALUES
(2, 'nicolas', 'sammarco', 'nico@g.com', 'nicosam', 'admin', 'pasword', 'assets/img/avatars29-01-pm-19-41-39-IMG_20180127_155003362.jpg'),
(20, 'asd', 'asd', 'taller@a.com', 'taller', 'Taller', 'taller', 'assets/img/avatars29-01-pm-19-41-39-IMG_20180127_155003362.jpg'),
(21, 'nico', NULL, 'admin@admin.com', 'admin', 'admin', 'admin', 'assets/img/avatars29-01-pm-19-41-39-IMG_20180127_155003362.jpg'),
(22, 'agente', 'agente', 'agente@g.com', 'agente', 'agente', 'agente', 'assets/img/avatars29-01-pm-19-41-39-IMG_20180127_155003362.jpg'),
(27, 'nicolas', 'sammarco', 'nico@gmail.com', 'nicosam2', 'admin', 'admin', 'assets/img/avatars29-01-pm-19-41-39-IMG_20180127_155003362.jpg'),
(32, 'victoria', 'hernandez', 'viky@hotmail.com', 'viky', 'Taller', '123', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividades`);

--
-- Indices de la tabla `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`id_agente`),
  ADD KEY `ubicacion` (`ubicacion`,`division`),
  ADD KEY `division` (`division`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyectos`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tareas`),
  ADD KEY `id_proyectos` (`id_proyectos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividades` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `agente`
--
ALTER TABLE `agente`
  MODIFY `id_agente` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyectos` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tareas` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
