-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2025 a las 22:52:03
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
-- Base de datos: `renty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id` int(11) NOT NULL,
  `matricula` varchar(11) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dni`, `nombre`, `apellidos`, `email`) VALUES
('12345678A', 'Laura', 'Gómez Pérez', 'laura.gomez@example.com'),
('23456789B', 'Carlos', 'Martín López', 'carlos.martin@example.com'),
('34567890C', 'Marta', 'Fernández Ruiz', 'marta.fernandez@example.com'),
('45678901D', 'David', 'Sánchez Morales', 'david.sanchez@example.com'),
('56789012E', 'Ana', 'López Torres', 'ana.lopez@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `matricula` varchar(11) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `precio_alquiler` decimal(10,2) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `imagen_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`matricula`, `modelo`, `anio`, `precio_alquiler`, `disponible`, `id_sede`, `id_marca`, `imagen_url`) VALUES
('1234ABC', 'F-Type Classic', 1971, 400.00, 1, 1, 1, 'images/e-type.png'),
('2345BCD', '911 Carrera RS', 1994, 525.00, 1, 2, 2, 'images/911.png'),
('3456CDE', '300 SL', 1970, 1000.00, 1, 3, 3, 'images/300slg.png'),
('4567DEF', 'F40', 1989, 1750.00, 1, 4, 4, 'images/f40.png'),
('5678EFG', 'M1', 1979, 900.00, 1, 1, 5, 'images/e26-m1.png'),
('6789FGH', 'EVO37', 2021, 1050.00, 1, 2, 6, 'images/evo37.png'),
('7890GHI', 'DB5', 1964, 1500.00, 1, 3, 7, 'images/db5.png'),
('8901HIJ', 'NSX', 1991, 500.00, 1, 4, 8, 'images/nsx.png'),
('B6727TR', '512-TR', 1992, 1200.00, 1, 1, 4, 'images/512-TR.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`) VALUES
(1, 'Jaguar'),
(2, 'Porsche'),
(3, 'Mercedes'),
(4, 'Ferrari'),
(5, 'BMW'),
(6, 'Kimera'),
(7, 'Aston Martin'),
(8, 'Honda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `nombre`, `direccion`) VALUES
(1, 'Sede Madrid', 'Calle de Alcalá, 42, 28014 Madrid'),
(2, 'Sede Sevilla', 'Avenida de la Constitución, 10, 41004 Sevilla'),
(3, 'Sede Valencia', 'Carrer de Colón, 56, 46004 Valencia'),
(4, 'Sede Bilbao', 'Gran Vía de Don Diego López de Haro, 15, 48011 Bilbao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos_clientes`
--

CREATE TABLE `telefonos_clientes` (
  `id` int(11) NOT NULL,
  `dni_cliente` varchar(9) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `telefonos_clientes`
--

INSERT INTO `telefonos_clientes` (`id`, `dni_cliente`, `telefono`) VALUES
(1, '12345678A', '600123456'),
(2, '12345678A', '600654321'),
(3, '23456789B', '611987654'),
(4, '34567890C', '622123456'),
(5, '45678901D', '633987654'),
(6, '56789012E', '644123987'),
(7, '56789012E', '644987123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni_cliente` (`dni_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `coches` (`matricula`),
  ADD CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `clientes` (`dni`);

--
-- Filtros para la tabla `coches`
--
ALTER TABLE `coches`
  ADD CONSTRAINT `coches_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`),
  ADD CONSTRAINT `coches_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  ADD CONSTRAINT `telefonos_clientes_ibfk_1` FOREIGN KEY (`dni_cliente`) REFERENCES `clientes` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
