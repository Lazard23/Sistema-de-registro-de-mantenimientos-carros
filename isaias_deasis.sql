-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2024 a las 21:21:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `isaias_deasis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalle` varchar(250) NOT NULL,
  `monto_pago` decimal(20,2) NOT NULL,
  `id_vehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id`, `fecha`, `detalle`, `monto_pago`, `id_vehiculo`) VALUES
(1, '2024-10-05', 'Cambio de aceite y filtro', 100.00, 1),
(2, '2024-10-05', 'Cambio de aceite y filtro', 15.00, 1),
(3, '2024-10-04', 'Cambio de frenos', 30.00, 2),
(4, '2024-10-11', 'Cambio de llanta', 20.00, 1),
(6, '2024-08-28', 'Cambio de aceite y filtro 1', 20.00, 1),
(7, '2024-10-12', 'Cambio de frenos 2', 20.00, 2),
(8, '2024-10-02', 'Cambio de frenos 3', 20.00, 2),
(9, '2024-10-04', 'Cambio de frenos 4', 30.00, 1),
(10, '2024-10-05', 'Cambio de aceite y filtro', 15.00, 1),
(11, '2024-10-10', 'Cambio de frenos 2 ', 20.00, 1),
(12, '2024-10-10', 'Cambio de frenos 2 ', 20.00, 1),
(13, '2024-10-10', 'Cambio de frenos 2 ', 20.00, 1),
(14, '2024-10-10', 'Cambio de frenos 2 ', 20.00, 1),
(15, '2024-10-05', 'Cambio de aceite y filtro 24', 15.00, 1),
(16, '2024-10-10', 'Cambio de frenos 4', 60.00, 1),
(17, '2024-10-02', 'Cambio de frenos 6', 20.00, 2),
(18, '2024-10-04', 'Cambio de frenos 10', 65.00, 1),
(19, '2024-10-02', 'Cambio de frenos 3', 20.00, 2),
(20, '2024-10-02', 'Cambio de frenos 3', 25.00, 2),
(21, '2024-10-02', 'Cambio de frenos 70', 70.00, 1),
(22, '2024-10-02', 'Cambio de frenos 70', 80.00, 1),
(23, '2024-10-26', 'Cambio de aceite y filtro', 200.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `año` int(11) NOT NULL,
  `placa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `nombre`, `marca`, `modelo`, `año`, `placa`) VALUES
(1, 'Vehiculo 1', 'Mercedes Benz', 'ABC', 2017, 'PC1234'),
(2, 'Vehiculo 2', 'FORD', 'XYZ', 2020, 'PC5678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
