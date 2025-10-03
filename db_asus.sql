-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2025 a las 02:04:17
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
-- Base de datos: `db_asus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria`, `nombre`) VALUES
(1, 'Gamer'),
(2, 'Oficina'),
(3, 'Estudio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notebooks`
--

CREATE TABLE `notebooks` (
  `id` int(11) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(15) NOT NULL,
  `categoria_id` int(2) NOT NULL,
  `img` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `notebooks`
--

INSERT INTO `notebooks` (`id`, `modelo`, `descripcion`, `precio`, `categoria_id`, `img`) VALUES
(1, 'ASUS ROG Strix G15', 'Notebook Gamer con procesador AMD Ryzen 9, 16GB RAM, RTX 3070', 650000, 1, 'https://dlcdnwebimgs.asus.com/gain/6D1F9EF4-02D6-455B-9D43-348275816538/w1000/h732'),
(2, 'ASUS TUF Dash F15', 'Notebook Gamer con Intel i7, 16GB RAM, RTX 3060', 580000, 1, 'https://dlcdnwebimgs.asus.com/gain/769aaa49-031e-4a90-b03c-3091198e95a1/'),
(3, 'ASUS ZenBook 14', 'Notebook ultradelgada para oficina, Intel i5, 8GB RAM, SSD 512GB', 220000, 2, 'https://dlcdnwebimgs.asus.com/gain/838fbdac-6d10-4190-8e52-d4b9463f5d23/'),
(4, 'ASUS VivoBook 15', 'Notebook para oficina con Intel i3, 8GB RAM, SSD 256GB', 150000, 2, 'https://www.asus.com/media/global/gallery/1qq8vmq0mcqfgefj_setting_xxx_0_90_end_2000.png'),
(5, 'ASUS ROG Zephyrus G14', 'Notebook Gamer con AMD Ryzen 9, 16GB RAM, RTX 3060', 620000, 1, 'https://dlcdnwebimgs.asus.com/gain/D366E1B6-C6E2-41B1-BF53-EF909B21FF09'),
(6, 'ASUS ExpertBook B1', 'Notebook para estudio y oficina, Intel i5, 8GB RAM, SSD 512GB', 180000, 3, 'https://dlcdnwebimgs.asus.com/gain/64195b02-e675-403b-8ace-f443b01b1c67/'),
(7, 'ASUS TUF Gaming A15', 'Notebook Gamer con AMD Ryzen 7, 16GB RAM, GTX 1660Ti', 550000, 1, 'https://dlcdnwebimgs.asus.com/gain/8432AFD3-FF1A-4017-BA47-E3B43351F04F/w1000/h732'),
(8, 'ASUS ZenBook 13', 'Notebook ultracompacta para estudio, Intel i5, 8GB RAM, SSD 256GB', 170000, 3, 'https://dlcdnwebimgs.asus.com/gain/ea0197dd-1be7-4ae9-a831-020c205930d7/'),
(9, 'ASUS VivoBook S14', 'Notebook para oficina y estudio, Intel i5, 8GB RAM, SSD 512GB', 200000, 2, 'https://dlcdnwebimgs.asus.com/gain/7ed0542b-234d-4970-85d7-39012107f96b/'),
(10, 'ASUS ROG Flow X13', 'Notebook Gamer convertible, AMD Ryzen 9, 16GB RAM, RTX 3050', 650000, 1, 'https://dlcdnwebimgs.asus.com/gain/8432AFD3-FF1A-4017-BA47-E3B43351F04F/w1000/h732');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria`) USING BTREE;

--
-- Indices de la tabla `notebooks`
--
ALTER TABLE `notebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notebooks`
--
ALTER TABLE `notebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notebooks`
--
ALTER TABLE `notebooks`
  ADD CONSTRAINT `notebooks_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
